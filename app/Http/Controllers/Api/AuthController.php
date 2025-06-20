<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Persona;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_p' => 'required|string|max:255',
            'apellido_m' => 'required|string|max:255',
            'sexo' => 'required|in:H,M',
            'curp' => 'nullable|string|max:18|unique:personas,curp',
            'correo' => 'required|email|unique:personas,correo',
            'contrasena' => 'required|string|min:6|confirmed',
        ]);

        $persona = Persona::create([
            'nombre' => $validated['nombre'],
            'apellido_p' => $validated['apellido_p'],
            'apellido_m' => $validated['apellido_m'],
            'sexo' => $validated['sexo'],
            'curp' => $validated['curp'] ?? null,
            'correo' => $validated['correo'],
            'contrasena' => Hash::make($validated['contrasena']),
        ]);

        $token = $persona->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Registro exitoso',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'persona' => $persona,
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'contrasena' => 'required',
        ]);

        $persona = Persona::where('correo', $request->correo)->first();

        if (! $persona || ! Hash::check($request->contrasena, $persona->contrasena)) {
            throw ValidationException::withMessages([
                'correo' => ['Las credenciales son incorrectas.'],
            ]);
        }

        $token = $persona->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login exitoso',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'persona' => $persona,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Sesión cerrada correctamente']);
    }

    public function perfil(Request $request)
    {
        return response()->json($request->user());
    }
}
