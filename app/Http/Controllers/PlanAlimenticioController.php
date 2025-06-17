<?php

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
            $agrupadas = $response->json('agrupadas');
            return view('pages.plan_alimenticio', compact('agrupadas'));
        } else {
            return back()->with('error', 'No se pudo obtener la recomendación.');
        }
    }
}
