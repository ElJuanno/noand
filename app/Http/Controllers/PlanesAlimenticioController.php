<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlanesAlimenticioController extends Controller
{
    public function show(Request $request)
    {
        $u = $request->user() ?? Auth::user(); // persona autenticada

        // ===== IMC / Glucosa =====
        $imcUsuario     = data_get($u, 'imc');
        $glucosaUsuario = data_get($u, 'glucosa');

        // Si no hay IMC guardado, lo calculamos con peso/altura (en m o cm)
        if (!$imcUsuario) {
            $peso   = data_get($u, 'peso') ?? data_get($u, 'peso_kg') ?? data_get($u, 'weight_kg');
            $altura = data_get($u, 'altura') ?? data_get($u, 'altura_cm') ?? data_get($u, 'height_cm');
            if ($peso && $altura) {
                $alturaM   = $altura > 5 ? ($altura / 100) : $altura; // si viene en cm -> m
                if ($alturaM > 0) {
                    $imcUsuario = round($peso / ($alturaM * $alturaM), 1);
                }
            }
        }

        $imc     = (float) ($imcUsuario ?? 24.0);
        $glucosa = (float) ($glucosaUsuario ?? 100);

        // ===== Modo y semilla =====
        $modoPreferido = data_get($u, 'plan_modo');
        $modo = in_array($modoPreferido, ['agrupadas', 'semanal3', 'semanal4']) ? $modoPreferido : 'semanal4';
        $seed = (int) (data_get($u, 'plan_seed') ?? data_get($u, 'id') ?? 42);

        // ===== Alergias (IDs) =====
        // Si tienes la relación ->alergias() en el modelo Persona, se usa; si no, lee directo de la tabla pivote.
        if (method_exists($u, 'alergias')) {
            $alergiasIds = $u->alergias()->pluck('alergias.id')->map(fn ($v) => (int) $v)->values();
        } else {
            $alergiasIds = DB::table('alergia_persona')
                ->where('persona_id', $u->id)
                ->pluck('alergia_id')
                ->map(fn ($v) => (int) $v)
                ->values();
        }

        // ===== Llamada a Flask =====
        $flaskUrl = rtrim(env('FLASK_URL', 'http://127.0.0.1:5000'), '/') . '/api/plan';
        $payload = [
            'imc'          => $imc,
            'glucosa'      => $glucosa,
            'modo'         => $modo,
            'aleatorio'    => true,
            'seed'         => $seed,
            'alergias_ids' => $alergiasIds,   // <<<<<< CLAVE PARA FILTRAR POR ALERGIAS
        ];

        $agrupadas = [];
        $semanal   = [];

        try {
            $resp = Http::timeout(60)->post($flaskUrl, $payload);
            if ($resp->successful()) {
                $json      = $resp->json();
                $agrupadas = $json['agrupadas'] ?? [];
                $semanal   = $json['semanal'] ?? [];
            }
        } catch (\Throwable $e) {
            // \Log::error($e->getMessage());
        }

        return view('pages.planes_alimenticio', compact(
            'agrupadas', 'semanal', 'modo', 'imc', 'glucosa', 'seed'
        ));
    }
}
