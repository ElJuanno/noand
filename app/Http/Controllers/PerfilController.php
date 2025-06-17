<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\MedidaAntropometrica;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PerfilController extends Controller
{
    public function edit()
    {
        $persona = Auth::user();
        $medidaAntro = \App\Models\MedidaAntropometrica::where('id_persona', $persona->id)->latest()->first();

        // Calcular IMC solo si hay peso y altura válidos
        $imc = null;
        if ($medidaAntro && $medidaAntro->peso > 0 && $medidaAntro->altura > 0) {
            $imc = round($medidaAntro->peso / ($medidaAntro->altura * $medidaAntro->altura), 2);
        }

        return view('perfil', compact('persona', 'medidaAntro', 'imc'));
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
            'foto' => 'nullable|image|max:2048',
        ]);

        // Foto de perfil
        if ($request->hasFile('foto')) {
            if ($persona->foto && Storage::disk('public')->exists($persona->foto)) {
                Storage::disk('public')->delete($persona->foto);
            }
            $path = $request->file('foto')->store('perfiles', 'public');
            $persona->foto = $path;
        }

        // Actualiza datos personales
        $persona->nombre = $request->nombre;
        $persona->apellido_p = $request->apellido_p;
        $persona->apellido_m = $request->apellido_m;
        $persona->sexo = $request->sexo;
        $persona->curp = $request->curp;
        $persona->correo = $request->correo;
        $persona->save();

        // Guarda o actualiza medida antropométrica
        MedidaAntropometrica::updateOrCreate(
            ['id_persona' => $persona->id],
            [
                'peso' => $request->peso,
                'altura' => $request->altura,
            ]
        );

        return redirect()->route('perfil')->with('success', 'Perfil actualizado correctamente.');
    }
}
