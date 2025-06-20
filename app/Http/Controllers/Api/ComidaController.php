<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comida;
use Illuminate\Http\Request;

class ComidaController extends Controller
{
    public function index()
    {
        $comidas = Comida::all();
        return response()->json($comidas);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'horario' => 'required|string',
            'calorias' => 'nullable|numeric',
            'azucar' => 'nullable|numeric',
            'carbohidratos' => 'nullable|numeric',
        ]);

        $comida = Comida::updateOrCreate(
            ['nombre' => $request->nombre],
            [
                'horario' => $request->horario,
                'calorias' => $request->calorias ?? 0,
                'azucar' => $request->azucar ?? 0,
                'carbohidratos' => $request->carbohidratos ?? 0,
            ]
        );

        return response()->json(['message' => 'Comida registrada/actualizada correctamente', 'comida' => $comida], 201);
    }

}
