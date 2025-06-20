<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MedidaSalud;
use Illuminate\Support\Facades\Auth;

class MedidaSaludApiController extends Controller
{
    public function show()
    {
        $medida = MedidaSalud::where('id_persona', Auth::id())->first();

        return response()->json($medida ?? []);
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

        $medida = MedidaSalud::updateOrCreate(
            ['id_persona' => Auth::id()],
            [
                'glucosa'    => $request->glucosa,
                'presion'    => $request->presion,
                'frecuencia' => $request->frecuencia,
                'condicion'  => $request->condicion,
                'edad'       => $request->edad,
            ]
        );

        return response()->json([
            'message' => 'Medidas de salud guardadas correctamente.',
            'data' => $medida
        ], 200);
    }
}
