<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        $usuarios = !empty($keyword)
            ? Usuario::where('matricula', 'LIKE', "%$keyword%")->latest()->paginate($perPage)
            : Usuario::latest()->paginate($perPage);

        return view('usuarios.usuario.index', compact('usuarios'));
    }

    public function create()
    {
        $personas = \App\Models\Persona::all();
        $seguimientos = \App\Models\Seguimiento::all();
        $asignas = \App\Models\AsignaPadecimiento::all();

        return view('usuarios.usuario.create', compact('personas', 'seguimientos', 'asignas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_persona' => 'nullable|integer|exists:personas,id',
            'matricula' => 'nullable|string|max:255',
            'id_seguimiento' => 'nullable|integer|exists:seguimientos,id',
            'id_asigna_p' => 'nullable|integer|exists:asigna_padecimientos,id',
        ]);

        Usuario::create($validated);

        return redirect()->route('usuario.index')->with('flash_message', 'Usuario creado correctamente.');
    }

    public function show($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.usuario.show', compact('usuario'));
    }

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        $personas = \App\Models\Persona::all();
        $seguimientos = \App\Models\Seguimiento::all();
        $asignas = \App\Models\AsignaPadecimiento::all();

        return view('usuarios.usuario.edit', compact('usuario', 'personas', 'seguimientos', 'asignas'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_persona' => 'nullable|integer|exists:personas,id',
            'matricula' => 'nullable|string|max:255',
            'id_seguimiento' => 'nullable|integer|exists:seguimientos,id',
            'id_asigna_p' => 'nullable|integer|exists:asigna_padecimientos,id',
        ]);

        $usuario = Usuario::findOrFail($id);
        $usuario->update($validated);

        return redirect()->route('usuario.index')->with('flash_message', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        Usuario::destroy($id);
        return redirect()->route('usuario.index')->with('flash_message', 'Usuario eliminado.');
    }
}
