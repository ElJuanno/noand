<?php

namespace App\Http\Controllers;

use App\Models\MedidaAntropometrica;
use App\Models\NivelPeso;
use Illuminate\Http\Request;

class MedidaAntropometricaController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        $medidas = !empty($keyword)
            ? MedidaAntropometrica::where('peso', 'LIKE', "%$keyword%")->latest()->paginate($perPage)
            : MedidaAntropometrica::latest()->paginate($perPage);

        return view('medida_antropometricas.medida_antropometrica.index', compact('medidas'));
    }

    public function create()
    {
        $niveles = NivelPeso::all();
        return view('medida_antropometricas.medida_antropometrica.create', compact('niveles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'peso' => 'required|numeric',
            'talla' => 'required|numeric',
            'imc' => 'nullable|numeric',
            'perimetro_abdominal' => 'nullable|numeric',
            'id_nivel_p' => 'nullable|integer|exists:nivel_pesos,id',
        ]);

        MedidaAntropometrica::create($validated);

        return redirect()->route('medida_antropometrica.index')->with('flash_message', 'Medida registrada correctamente.');
    }

    public function show($id)
    {
        $medida = MedidaAntropometrica::findOrFail($id);
        return view('medida_antropometricas.medida_antropometrica.show', compact('medida'));
    }

    public function edit($id)
    {
        $medida = MedidaAntropometrica::findOrFail($id);
        $niveles = NivelPeso::all();
        return view('medida_antropometricas.medida_antropometrica.edit', compact('medida', 'niveles'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'peso' => 'required|numeric',
            'talla' => 'required|numeric',
            'imc' => 'nullable|numeric',
            'perimetro_abdominal' => 'nullable|numeric',
            'id_nivel_p' => 'nullable|integer|exists:nivel_pesos,id',
        ]);

        $medida = MedidaAntropometrica::findOrFail($id);
        $medida->update($validated);

        return redirect()->route('medida_antropometrica.index')->with('flash_message', 'Medida actualizada correctamente.');
    }

    public function destroy($id)
    {
        MedidaAntropometrica::destroy($id);
        return redirect()->route('medida_antropometrica.index')->with('flash_message', 'Medida eliminada.');
    }
}
