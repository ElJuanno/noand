<?php
// app/Http/Controllers/PlanAlimenticioController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\MedidaAntropometrica;
use App\Models\MedidaSalud;

class PlanAlimenticioController extends Controller
{
    public function show()
    {
        $persona = Auth::user();

        $medidaAntro = MedidaAntropometrica::where('id_persona', $persona->id)->latest()->first();
        $medidaSalud = MedidaSalud::where('id_persona', $persona->id)->latest()->first();

        if (!$medidaAntro || !$medidaSalud) {
            return redirect()->route('perfil')->with('error', 'Completa tus datos de salud y perfil primero.');
        }

        $imc = $medidaAntro->peso / ($medidaAntro->altura * $medidaAntro->altura);

        // === Alergias del usuario (IDs) ===
        $alergiasIds = $persona->alergias()->pluck('alergias.id')->map(fn($v)=>(int)$v)->values();

        $data = [
            'glucosa'      => (float) $medidaSalud->glucosa,
            'imc'          => (float) $imc,
            'modo'         => 'agrupadas',
            'aleatorio'    => true,
            'seed'         => (int) ($persona->id ?? 42),
            'alergias_ids' => $alergiasIds,   // <<<<<< IMPORTANTÍSIMO
        ];

        $resp = Http::timeout(60)->post(
            rtrim(env('FLASK_URL','http://127.0.0.1:5000'), '/').'/api/plan',
            $data
        );

        if (!$resp->successful()) {
            return back()->with('error','No se pudo obtener la recomendación.');
        }

        $agrupadas = $resp->json('agrupadas') ?? [];

        // pásalo a tu Blade
        return view('pages.plan_alimenticio', compact('agrupadas', 'imc'))
               ->with('glucosa', $medidaSalud->glucosa);
    }
}
