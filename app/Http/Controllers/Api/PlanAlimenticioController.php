<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PlanAlimenticioController extends Controller
{
    public function show()
    {
        $persona = Auth::user();

        // Suponiendo que tienes método para obtener imc, glucosa, edad
        $imc = $persona->calcularIMC(); // o calcula aquí con sus datos
        $glucosa = $persona->ultimaGlucosa(); // o trae el dato guardado
        $edad = $persona->edad; // ejemplo

        $data = [
            'glucosa' => $glucosa,
            'imc' => $imc,
            'edad' => $edad,
            'condicion' => '', // dejamos vacío
        ];

        // Llamar al servicio python de recomendación
        $response = Http::timeout(90)->post('http://127.0.0.1:5000/api/recomendar', $data);

        if ($response->successful()) {
            $agrupadas = $response->json('recetas');
            return response()->json($agrupadas);
        } else {
            return response()->json(['error' => 'No se pudo obtener la recomendación'], 500);
        }
    }
}
