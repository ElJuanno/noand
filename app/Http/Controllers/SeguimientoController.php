<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comida;
use App\Models\Seguimiento;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SeguimientoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comida_id' => 'required|exists:comidas,id',
            // Otros datos si se agregan
        ]);

        $comida = Comida::findOrFail($request->comida_id);

        // Guardar comida con referencia a comida
        Seguimiento::create([
            'id_persona' => Auth::id(),
            'id_comida'  => $comida->id,
            'fecha'      => Carbon::today(),
            'hora'       => $comida->hora,  // Copiamos la hora desde la tabla comidas
            'notas'      => null,
        ]);

        return back()->with('success', 'Comida registrada en comida correctamente.');
    }
}
