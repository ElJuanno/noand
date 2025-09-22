<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PeriodoController extends Controller
{
    public function edit()
    {
        $persona = session('persona');

        if (!$persona) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión');
        }

        return view('perfil', ['persona' => $persona]);
    }

    public function update(Request $request)
    {
        $persona = Persona::find(session('persona')->id);

        if (!$persona) {
            return redirect()->route('login');
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_p' => 'required|string|max:255',
            'apellido_m' => 'required|string|max:255',
            'sexo' => 'required|in:H,M',
            'curp' => 'nullable|string|max:18|unique:personas,curp,' . $persona->id,
            'correo' => 'required|email|unique:personas,correo,' . $persona->id,
            'foto' => 'nullable|image|max:2048',
        ]);

        // Manejo de imagen
        if ($request->hasFile('foto')) {
            if ($persona->foto) {
                Storage::disk('public')->delete($persona->foto); // Borra la anterior
            }

            $path = $request->file('foto')->store('perfiles', 'public');
            $persona->foto = $path;
        }

        $persona->update([
            'nombre' => $request->nombre,
            'apellido_p' => $request->apellido_p,
            'apellido_m' => $request->apellido_m,
            'sexo' => $request->sexo,
            'curp' => $request->curp,
            'correo' => $request->correo,
        ]);

        session(['persona' => $persona]);

        return redirect()->route('perfil')->with('success', 'Perfil actualizado correctamente.');
    }
}
