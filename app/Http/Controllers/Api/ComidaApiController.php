<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ComidaApiController extends Controller
{
    public function registrar(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'hora' => 'required|string',
            'calorias' => 'required|numeric',
            'azucar' => 'required|numeric',
            'carbohidratos' => 'required|numeric',
        ]);

        $personaId = Auth::id();
        $fechaHoy = now()->toDateString();

        $comida = DB::table('comidas')->where('nombre', $request->nombre)->first();

        if (!$comida) {
            $comidaId = DB::table('comidas')->insertGetId([
                'nombre' => $request->nombre,
                'horario' => $request->hora,
                'calorias' => $request->calorias,
                'azucar' => $request->azucar,
                'carbohidratos' => $request->carbohidratos,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $comidaId = $comida->id;
        }

        DB::table('seguimientos')->insert([
            'id_persona' => $personaId,
            'id_comida'  => $comidaId,
            'fecha'      => $fechaHoy,
            'notas'      => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['message' => 'Comida registrada con éxito'], 201);
    }
}
