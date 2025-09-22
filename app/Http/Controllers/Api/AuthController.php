<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Persona;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $r)
    {
        $v = $r->validate([
            'nombre'       => 'required|string|max:255',
            'apellido_p'   => 'required|string|max:255',
            'apellido_m'   => 'required|string|max:255',
            'sexo'         => 'required|in:H,M',
            'curp'         => 'nullable|string|max:18|unique:personas,curp',
            'correo'       => 'required|email|unique:personas,correo',
            'contrasena'   => 'required|string|min:6|confirmed',
        ]);

        $p = Persona::create([
            'nombre'      => $v['nombre'],
            'apellido_p'  => $v['apellido_p'],
            'apellido_m'  => $v['apellido_m'],
            'sexo'        => $v['sexo'],
            'curp'        => $v['curp'] ?? null,
            'correo'      => $v['correo'],
            'contrasena'  => Hash::make($v['contrasena']),
        ]);

        $token = $p->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'      => 'Registro exitoso',
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'persona'      => $p,
        ], 201);
    }

    public function login(Request $r)
    {
        $r->validate([
            'correo'     => 'required|email',
            'contrasena' => 'required',
        ]);

        $p = Persona::where('correo', $r->correo)->first();

        if (!$p || !Hash::check($r->contrasena, $p->contrasena)) {
            throw ValidationException::withMessages([
                'correo' => ['Las credenciales son incorrectas.'],
            ]);
        }

        $token = $p->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'      => 'Login exitoso',
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'persona'      => $p,
        ]);
    }

    public function logout(Request $r)
    {
        $r->user()->tokens()->delete();
        return response()->json(['message' => 'Sesión cerrada correctamente']);
    }

    public function perfil(Request $r)
    {
        return response()->json($r->user());
    }
}
