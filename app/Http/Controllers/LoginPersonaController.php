<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginPersonaController extends Controller
{
    public function login(Request $request)
    {
        $persona = Persona::where('correo', $request->correo)->first();

        if (!$persona || !Hash::check($request->contrasena, $persona->contrasena)) {
            return back()->with('error', 'Credenciales incorrectas');
        }

        Auth::login($persona);

        $request->session()->regenerate();

        return redirect()->route('home');
    }
}
