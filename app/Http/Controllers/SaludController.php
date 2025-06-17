<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MedidaSalud;
use App\Models\MedidaAntropometrica;

class SaludController extends Controller
{
    public function create()
    {
        return view('salud.registro');
    }

    public function store(Request $request)
    {
        $request->validate([
            'glucosa' => 'required|numeric|min:50|max:500',
            'condicion' => 'required|string|max:255',
            'peso' => 'required|numeric|min:20|max:300',
            'altura' => 'required|numeric|min:0.5|max:2.5',
            'edad' => 'required|integer|min:1|max:120',
        ]);

        // Guardar medida de salud
        $medida = new MedidaSalud();
        $medida->glucosa = $request->glucosa;
        $medida->condicion = $request->condicion;
        $medida->edad = $request->edad;
        $medida->id_persona = Auth::user()->id;
        $medida->save();

        // Guardar peso y altura en medida_antropometricas
        $antropo = new MedidaAntropometrica();
        $antropo->peso = $request->peso;
        $antropo->altura = $request->altura;
        $antropo->id_persona = Auth::user()->id;
        $antropo->save();

        // Redirigir a una vista de recomendaciones (la armamos después)
        return redirect()->route('salud.create')->with('success', 'Datos registrados correctamente. ¡Ya puedes obtener recomendaciones!');
    }
}
