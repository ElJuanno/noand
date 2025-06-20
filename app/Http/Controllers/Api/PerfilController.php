<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\MedidaAntropometrica;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    public function show()
    {
        $persona = Auth::user();
        $medida = MedidaAntropometrica::where('id_persona', $persona->id)->latest()->first();

        $imc = null;
        if ($medida && $medida->peso > 0 && $medida->altura > 0) {
            $imc = round($medida->peso / ($medida->altura ** 2), 2);
        }

        return response()->json([
            'persona' => $persona,
            'medidas' => $medida,
            'imc' => $imc,
        ]);
    }

    public function update(Request $request)
    {
        $persona = Auth::user();

        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_p' => 'required|string|max:255',
            'apellido_m' => 'required|string|max:255',
            'sexo' => 'required|in:H,M',
            'curp' => 'nullable|string|max:18|unique:personas,curp,' . $persona->id,
            'correo' => 'required|email|unique:personas,correo,' . $persona->id,
            'peso' => 'required|numeric|min:10|max:350',
            'altura' => 'required|numeric|min:0.5|max:2.5',
        ]);

        $persona->update($request->only('nombre', 'apellido_p', 'apellido_m', 'sexo', 'curp', 'correo'));

        MedidaAntropometrica::updateOrCreate(
            ['id_persona' => $persona->id],
            ['peso' => $request->peso, 'altura' => $request->altura]
        );

        return response()->json(['message' => 'Perfil actualizado correctamente.']);
    }
}
