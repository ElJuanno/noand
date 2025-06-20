<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\MedidaAntropometrica;
use App\Models\MedidaSalud;

class PlanAlimenticioApiController extends Controller
{
    public function show()
    {
        $persona = Auth::user();
        $medidaAntro = MedidaAntropometrica::where('id_persona', $persona->id)->latest()->first();
        $medidaSalud = MedidaSalud::where('id_persona', $persona->id)->latest()->first();

        if (!$medidaAntro || !$medidaSalud) {
            return response()->json(['error' => 'Datos incompletos'], 400);
        }

        $peso = $medidaAntro->peso;
        $altura = $medidaAntro->altura;
        $imc = $peso / ($altura * $altura);

        $data = [
            'glucosa' => $medidaSalud->glucosa,
            'imc'     => $imc,
            'edad'    => $medidaSalud->edad,
        ];

        $response = Http::timeout(90)->post('http://127.0.0.1:5000/api/plan', $data);

        if ($response->successful()) {
            return response()->json([
                'agrupadas' => $response->json('agrupadas')
            ]);
        } else {
            return response()->json(['error' => 'No se pudo obtener la recomendaci\u00f3n'], 500);
        }
    }
}
