<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use Illuminate\Support\Facades\Hash;

class PersonaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_p' => 'required|string|max:255',
            'apellido_m' => 'required|string|max:255',
            'sexo' => 'required|in:H,M',
            'correo' => 'required|email|unique:personas,correo',
            'contrasena' => 'required|string|min:6|confirmed',
        ]);

        $persona = Persona::create([
            'nombre' => $request->nombre,
            'apellido_p' => $request->apellido_p,
            'apellido_m' => $request->apellido_m,
            'sexo' => $request->sexo,
            'curp' => $request->curp,
            'correo' => $request->correo,
            'contrasena' => Hash::make($request->contrasena),
        ]);

        return redirect()->route('login')->with('success', 'Usuario registrado correctamente. Ahora puedes iniciar sesión.');
    }
}
