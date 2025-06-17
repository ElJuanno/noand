<?php

namespace App\Http\Controllers;

use App\Models\AsignaUsuario;
use App\Models\AsignaGrupo;
use App\Models\Usuario;
use Illuminate\Http\Request;

class AsignaUsuarioController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        $asignaciones = !empty($keyword)
            ? AsignaUsuario::where('id_usuario', 'LIKE', "%$keyword%")->orWhere('id_asigna_g', 'LIKE', "%$keyword%")->latest()->paginate($perPage)
            : AsignaUsuario::latest()->paginate($perPage);

        return view('asigna_usuarios.asigna_usuario.index', compact('asignaciones'));
    }

    public function create()
    {
        $usuarios = Usuario::all();
        $asignacionesGrupos = AsignaGrupo::all();
        return view('asigna_usuarios.asigna_usuario.create', compact('usuarios', 'asignacionesGrupos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_asigna_g' => 'required|integer|exists:asigna_grupos,id',
            'id_usuario' => 'required|integer|exists:usuarios,id',
        ]);

        AsignaUsuario::create($validated);

        return redirect()->route('asigna_usuario.index')->with('flash_message', 'Usuario asignado correctamente.');
    }

    public function show($id)
    {
        $asignacion = AsignaUsuario::findOrFail($id);
        return view('asigna_usuarios.asigna_usuario.show', compact('asignacion'));
    }

    public function edit($id)
    {
        $asignacion = AsignaUsuario::findOrFail($id);
        $usuarios = Usuario::all();
        $asignacionesGrupos = AsignaGrupo::all();
        return view('asigna_usuarios.asigna_usuario.edit', compact('asignacion', 'usuarios', 'asignacionesGrupos'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_asigna_g' => 'required|integer|exists:asigna_grupos,id',
            'id_usuario' => 'required|integer|exists:usuarios,id',
        ]);

        $asignacion = AsignaUsuario::findOrFail($id);
        $asignacion->update($validated);

        return redirect()->route('asigna_usuario.index')->with('flash_message', 'Asignación actualizada correctamente.');
    }

    public function destroy($id)
    {
        AsignaUsuario::destroy($id);
        return redirect()->route('asigna_usuario.index')->with('flash_message', 'Asignación eliminada.');
    }
}
