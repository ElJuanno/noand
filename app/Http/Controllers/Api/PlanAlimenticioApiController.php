<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\MedidaAntropometrica;
use App\Models\MedidaSalud;

class PlanAlimenticioApiController extends Controller
{
    /** POST /api/plan/recetas
     * Body opcional: { "modo":"agrupadas", "seed":123 }
     * Devuelve lo que diga Flask en clave "agrupadas".
     */
    public function recetas(Request $r)
    {
        [$imc, $glucosa, $alergiasIds, $seed, $modo] = $this->payloadBase($r, 'agrupadas');

        $resp = $this->callFlask([
            'imc'          => $imc,
            'glucosa'      => $glucosa,
            'modo'         => $modo,       // "agrupadas"
            'aleatorio'    => true,
            'seed'         => $seed,
            'alergias_ids' => $alergiasIds,
        ]);

        if (!$resp['ok']) return response()->json(['message'=>'No disponible'], 502);

        return response()->json([
            'imc'       => $imc,
            'glucosa'   => $glucosa,
            'agrupadas' => $resp['json']['agrupadas'] ?? [],
        ]);
    }

    /** POST /api/plan/semanal
     * Body opcional: { "comidas_por_dia": 3|4, "calorias_objetivo": 2000, "seed":123 }
     * Devuelve lo que diga Flask en clave "semanal".
     */
    public function semanal(Request $r)
    {
        $cpd = (int) $r->input('comidas_por_dia', 4);
        $modo = $cpd === 3 ? 'semanal3' : 'semanal4';

        [$imc, $glucosa, $alergiasIds, $seed] = $this->payloadBase($r, $modo);

        $payload = [
            'imc'          => $imc,
            'glucosa'      => $glucosa,
            'modo'         => $modo,        // "semanal3" | "semanal4"
            'aleatorio'    => true,
            'seed'         => $seed,
            'alergias_ids' => $alergiasIds,
        ];

        if ($r->filled('calorias_objetivo')) {
            $payload['calorias_objetivo'] = (int) $r->input('calorias_objetivo');
        }

        $resp = $this->callFlask($payload);
        if (!$resp['ok']) return response()->json(['message'=>'No disponible'], 502);

        return response()->json([
            'imc'      => $imc,
            'glucosa'  => $glucosa,
            'semanal'  => $resp['json']['semanal'] ?? [],
        ]);
    }

    /* ================= Helpers ================= */

    /** Obtiene IMC, glucosa, alergias y seed por defecto */
    private function payloadBase(Request $r, string $modoDefault): array
    {
        $uid = $r->user()->id;

        // Última antropometría
        $antro = MedidaAntropometrica::where('id_persona', $uid)->latest()->first();
        $imc = null;
        if ($antro && $antro->peso && $antro->altura) {
            $imc = round($antro->peso / ($antro->altura * $antro->altura), 2);
        }

        // Última glucosa (si hay en MedidaSalud)
        $ms = MedidaSalud::where('id_persona', $uid)->whereNotNull('glucosa')->latest()->first();
        $glu = $ms ? (float) $ms->glucosa : null;

        // Alergias del usuario
        $alergiasIds = DB::table('alergia_persona')
            ->where('id_persona', $uid)
            ->pluck('alergia_id')
            ->map(fn($v) => (int) $v)
            ->values()
            ->all();

        $seed = (int) $r->input('seed', $uid);
        $modo = (string) $r->input('modo', $modoDefault);

        return [$imc, $glu, $alergiasIds, $seed, $modo];
    }

    /** Llama al servicio Flask según FLASK_URL en .env */
    private function callFlask(array $payload): array
    {
        $base = rtrim(env('FLASK_URL', ''), '/');
        if ($base === '') return ['ok' => false];

        try {
            $resp = Http::timeout(60)->post($base . '/api/plan', $payload);
            if (!$resp->successful()) return ['ok' => false];
            return ['ok' => true, 'json' => $resp->json()];
        } catch (\Throwable $e) {
            return ['ok' => false];
        }
    }
}
