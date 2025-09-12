<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PlanesAlimenticioController extends Controller
{
    public function show(Request $request)
    {
        $u = $request->user(); // usuario autenticado

        // ====== ORÍGENES DE DATOS (ajusta los nombres a tu schema) ======
        // Opción A: ya tienes imc y glucosa guardados en users
        $imcUsuario     = optional($u)->imc;          // ej: columna users.imc
        $glucosaUsuario = optional($u)->glucosa;      // ej: columna users.glucosa

        // Opción B: calcular IMC si no hay (peso/talla)
        // peso_kg, altura_cm son ejemplos; usa los tuyos (weight, height, etc.)
        if (!$imcUsuario) {
            $pesoKg   = optional($u)->peso_kg ?: optional($u)->weight_kg;
            $alturaCm = optional($u)->altura_cm ?: optional($u)->height_cm;
            if ($pesoKg && $alturaCm && $alturaCm > 0) {
                $imcUsuario = round($pesoKg / pow($alturaCm / 100, 2), 1);
            }
        }

        // Valores por defecto seguros si falta algo
        $imc     = (float) ($imcUsuario ?? 24.0);
        $glucosa = (float) ($glucosaUsuario ?? 100);

        // Modo preferido del usuario (si lo guardas). Valores posibles: 'agrupadas' | 'semanal4' | 'semanal3'
        $modoPreferido = optional($u)->plan_modo; // ej: users.plan_modo
        $modo = in_array($modoPreferido, ['agrupadas','semanal3','semanal4']) ? $modoPreferido : 'semanal4';

        // Semilla estable por usuario para que su plan sea reproducible
        $seed = (int) (optional($u)->plan_seed ?? $u->id ?? 42);

        // ====== Llamada al backend Flask ======
        $flaskUrl = rtrim(env('FLASK_URL', 'http://127.0.0.1:5000'), '/') . '/api/plan';
        $payload = [
            'imc'      => $imc,
            'glucosa'  => $glucosa,
            'modo'     => $modo,
            'aleatorio'=> true,     // puedes guardar esto en el usuario si quieres
            'seed'     => $seed,
        ];

        $agrupadas = [];
        $semanal   = [];

        try {
            $resp = Http::timeout(20)->post($flaskUrl, $payload);
            if ($resp->successful()) {
                $json = $resp->json();
                $agrupadas = $json['agrupadas'] ?? [];
                $semanal   = $json['semanal'] ?? [];
            }
        } catch (\Throwable $e) {
            // \Log::error($e->getMessage());
        }

        // Render sin formularios ni query params
        return view('pages.planes_alimenticio', compact(
            'agrupadas', 'semanal', 'modo', 'imc', 'glucosa', 'seed'
        ));
    }
}
