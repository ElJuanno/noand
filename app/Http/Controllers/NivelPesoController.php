<?php

namespace App\Http\Controllers;

use App\Models\NivelPeso;
use Illuminate\Http\Request;

class NivelPesoController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        $niveles = !empty($keyword)
            ? NivelPeso::where('descripcion', 'LIKE', "%$keyword%")->latest()->paginate($perPage)
            : NivelPeso::latest()->paginate($perPage);

        return view('nivel_pesos.nivel_peso.index', compact('niveles'));
    }

    public function create()
    {
        return view('nivel_pesos.nivel_peso.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'descripcion' => 'required|string|max:255',
        ]);

        NivelPeso::create($validated);

        return redirect()->route('nivel_peso.index')->with('flash_message', 'Nivel de peso registrado correctamente.');
    }

    public function show($id)
    {
        $nivel = NivelPeso::findOrFail($id);
        return view('nivel_pesos.nivel_peso.show', compact('nivel'));
    }

    public function edit($id)
    {
        $nivel = NivelPeso::findOrFail($id);
        return view('nivel_pesos.nivel_peso.edit', compact('nivel'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'descripcion' => 'required|string|max:255',
        ]);

        $nivel = NivelPeso::findOrFail($id);
        $nivel->update($validated);

        return redirect()->route('nivel_peso.index')->with('flash_message', 'Nivel de peso actualizado correctamente.');
    }

    public function destroy($id)
    {
        NivelPeso::destroy($id);
        return redirect()->route('nivel_peso.index')->with('flash_message', 'Nivel de peso eliminado.');
    }
}
