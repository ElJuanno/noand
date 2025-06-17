<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedidaSalud;
use Illuminate\Support\Facades\Auth;

class MedidaSaludController extends Controller
{
    public function create()
    {
        $medidaSalud = \App\Models\MedidaSalud::where('id_persona', Auth::id())->first();
        return view('pages.medidas_salud.registrar', compact('medidaSalud'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'glucosa'    => 'required|numeric|min:40|max:600',
            'presion'    => 'nullable|string|max:30',
            'frecuencia' => 'nullable|string|max:30',
            'condicion'  => 'nullable|string|max:255',
            'edad'       => 'required|integer|min:1|max:120',
        ]);

        MedidaSalud::updateOrCreate(
            ['id_persona' => Auth::id()],
            [
                'glucosa'    => $request->glucosa,
                'presion'    => $request->presion,
                'frecuencia' => $request->frecuencia,
                'condicion'  => $request->condicion,
                'edad'       => $request->edad,
            ]
        );

        return redirect()->route('medidas.salud.create')->with('success', 'Medidas de salud guardadas correctamente.');
    }

}
