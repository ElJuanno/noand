<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        $grupos = !empty($keyword)
            ? Grupo::where('descripcion', 'LIKE', "%$keyword%")->latest()->paginate($perPage)
            : Grupo::latest()->paginate($perPage);

        return view('grupos.grupo.index', compact('grupos'));
    }

    public function create()
    {
        return view('grupos.grupo.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'descripcion' => 'required|string|max:255',
        ]);

        Grupo::create($validated);

        return redirect()->route('grupo.index')->with('flash_message', 'Grupo registrado correctamente.');
    }

    public function show($id)
    {
        $grupo = Grupo::findOrFail($id);
        return view('grupos.grupo.show', compact('grupo'));
    }

    public function edit($id)
    {
        $grupo = Grupo::findOrFail($id);
        return view('grupos.grupo.edit', compact('grupo'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'descripcion' => 'required|string|max:255',
        ]);

        $grupo = Grupo::findOrFail($id);
        $grupo->update($validated);

        return redirect()->route('grupo.index')->with('flash_message', 'Grupo actualizado correctamente.');
    }

    public function destroy($id)
    {
        Grupo::destroy($id);
        return redirect()->route('grupo.index')->with('flash_message', 'Grupo eliminado.');
    }
}
