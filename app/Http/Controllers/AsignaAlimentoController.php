<?php

namespace App\Http\Controllers;

use App\Models\AsignaAlimento;
use Illuminate\Http\Request;

class AsignaAlimentoController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        $asignaalimento = !empty($keyword)
            ? AsignaAlimento::where('id_comida', 'LIKE', "%$keyword%")
                ->orWhere('id_alimento', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage)
            : AsignaAlimento::latest()->paginate($perPage);

        return view('asigna_alimentos.asigna-alimento.index', compact('asignaalimento'));
    }

    public function create()
    {
        return view('asigna_alimentos.asigna-alimento.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_comida' => 'required|integer|exists:comidas,id',
            'id_alimento' => 'required|integer|exists:alimentos,id',
        ]);

        AsignaAlimento::create($validated);

        return redirect()->route('asigna-alimento.index')->with('flash_message', 'Relación creada correctamente.');
    }

    public function show($id)
    {
        $asignaalimento = AsignaAlimento::findOrFail($id);
        return view('asigna_alimentos.asigna-alimento.show', compact('asignaalimento'));
    }

    public function edit($id)
    {
        $asignaalimento = AsignaAlimento::findOrFail($id);
        return view('asigna_alimentos.asigna-alimento.edit', compact('asignaalimento'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_comida' => 'required|integer|exists:comidas,id',
            'id_alimento' => 'required|integer|exists:alimentos,id',
        ]);

        $asignaalimento = AsignaAlimento::findOrFail($id);
        $asignaalimento->update($validated);

        return redirect()->route('asigna-alimento.index')->with('flash_message', 'Relación actualizada correctamente.');
    }

    public function destroy($id)
    {
        AsignaAlimento::destroy($id);
        return redirect()->route('asigna-alimento.index')->with('flash_message', 'Relación eliminada.');
    }
}
