<?php

namespace App\Http\Controllers;

use App\Models\AsignaComida;
use Illuminate\Http\Request;

class AsignaComidaController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        $asignacomida = !empty($keyword)
            ? AsignaComida::where('id_dieta', 'LIKE', "%$keyword%")
                ->orWhere('id_comida', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage)
            : AsignaComida::latest()->paginate($perPage);

        return view('asigna_comidas.asigna-comida.index', compact('asignacomida'));
    }

    public function create()
    {
        return view('asigna_comidas.asigna-comida.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_dieta' => 'required|integer|exists:dietas,id',
            'id_comida' => 'required|integer|exists:comidas,id',
        ]);

        AsignaComida::create($validated);

        return redirect()->route('asigna-comida.index')->with('flash_message', 'Asignación creada correctamente.');
    }

    public function show($id)
    {
        $asignacomida = AsignaComida::findOrFail($id);
        return view('asigna_comidas.asigna-comida.show', compact('asignacomida'));
    }

    public function edit($id)
    {
        $asignacomida = AsignaComida::findOrFail($id);
        return view('asigna_comidas.asigna-comida.edit', compact('asignacomida'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_dieta' => 'required|integer|exists:dietas,id',
            'id_comida' => 'required|integer|exists:comidas,id',
        ]);

        $asignacomida = AsignaComida::findOrFail($id);
        $asignacomida->update($validated);

        return redirect()->route('asigna-comida.index')->with('flash_message', 'Asignación actualizada.');
    }

    public function destroy($id)
    {
        AsignaComida::destroy($id);
        return redirect()->route('asigna-comida.index')->with('flash_message', 'Asignación eliminada.');
    }
}
