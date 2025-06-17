<?php

namespace App\Http\Controllers;

use App\Models\GrupoAlimento;
use Illuminate\Http\Request;

class GrupoAlimentoController extends Controller
{
    public function index()
    {
        $grupos = GrupoAlimento::latest()->paginate(25);
        return view('grupo_alimentos.grupo_alimento.index', compact('grupos'));
    }

    public function create()
    {
        return view('grupo_alimentos.grupo_alimento.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'descripcion' => 'required|string|max:255',
        ]);

        GrupoAlimento::create($validated);
        return redirect()->route('grupo_alimento.index')->with('flash_message', 'Grupo registrado correctamente.');
    }

    public function show($id)
    {
        $grupo = GrupoAlimento::findOrFail($id);
        return view('grupo_alimentos.grupo_alimento.show', compact('grupo'));
    }

    public function edit($id)
    {
        $grupo = GrupoAlimento::findOrFail($id);
        return view('grupo_alimentos.grupo_alimento.edit', compact('grupo'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'descripcion' => 'required|string|max:255',
        ]);

        $grupo = GrupoAlimento::findOrFail($id);
        $grupo->update($validated);
        return redirect()->route('grupo_alimento.index')->with('flash_message', 'Grupo actualizado correctamente.');
    }

    public function destroy($id)
    {
        GrupoAlimento::destroy($id);
        return redirect()->route('grupo_alimento.index')->with('flash_message', 'Grupo eliminado.');
    }
}
