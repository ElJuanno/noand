<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Persona;

class ProfileController extends Controller
{
    // Obtener datos del perfil (usuario autenticado)
    public function show(Request $request)
    {
        return response()->json($request->user());
    }

    // Actualizar datos del perfil
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'nombre'      => 'sometimes|required|string|max:255',
            'apellido_p'  => 'sometimes|required|string|max:255',
            'apellido_m'  => 'sometimes|nullable|string|max:255',
            'sexo'        => 'sometimes|required|string|max:1',
            'curp'        => 'sometimes|required|string|max:18',
            'correo'      => 'sometimes|required|email|unique:personas,correo,'.$user->id,
            'contrasena'  => 'sometimes|nullable|string|min:6|confirmed',
        ]);

        // Actualizar campos si vienen
        $user->fill($validated);

        if ($request->filled('contrasena')) {
            $user->contrasena = Hash::make($request->contrasena);
        }

        $user->save();

        return response()->json(['message' => 'Perfil actualizado correctamente', 'user' => $user]);
    }

    // Logout y revocar token
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Sesión cerrada correctamente']);
    }
}
