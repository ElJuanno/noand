<?php

namespace App\Http\Controllers;

use App\Models\AsignaGrupo;
use App\Models\Especialista;
use App\Models\Grupo;
use Illuminate\Http\Request;

class AsignaGrupoController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        $asignaciones = !empty($keyword)
            ? AsignaGrupo::where('id_especialista', 'LIKE', "%$keyword%")->orWhere('id_grupo', 'LIKE', "%$keyword%")->latest()->paginate($perPage)
            : AsignaGrupo::latest()->paginate($perPage);

        return view('asigna_grupos.asigna_grupo.index', compact('asignaciones'));
    }

    public function create()
    {
        $especialistas = Especialista::all();
        $grupos = Grupo::all();
        return view('asigna_grupos.asigna_grupo.create', compact('especialistas', 'grupos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_especialista' => 'required|integer|exists:especialistas,id',
            'id_grupo' => 'required|integer|exists:grupos,id',
        ]);

        AsignaGrupo::create($validated);

        return redirect()->route('asigna_grupo.index')->with('flash_message', 'Grupo asignado correctamente.');
    }

    public function show($id)
    {
        $asignacion = AsignaGrupo::findOrFail($id);
        return view('asigna_grupos.asigna_grupo.show', compact('asignacion'));
    }

    public function edit($id)
    {
        $asignacion = AsignaGrupo::findOrFail($id);
        $especialistas = Especialista::all();
        $grupos = Grupo::all();
        return view('asigna_grupos.asigna_grupo.edit', compact('asignacion', 'especialistas', 'grupos'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_especialista' => 'required|integer|exists:especialistas,id',
            'id_grupo' => 'required|integer|exists:grupos,id',
        ]);

        $asignacion = AsignaGrupo::findOrFail($id);
        $asignacion->update($validated);

        return redirect()->route('asigna_grupo.index')->with('flash_message', 'Asignación actualizada correctamente.');
    }

    public function destroy($id)
    {
        AsignaGrupo::destroy($id);
        return redirect()->route('asigna_grupo.index')->with('flash_message', 'Asignación eliminada.');
    }
}
