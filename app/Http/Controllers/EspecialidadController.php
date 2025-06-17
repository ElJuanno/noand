<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        $especialidades = !empty($keyword)
            ? Especialidad::where('descripcion', 'LIKE', "%$keyword%")->latest()->paginate($perPage)
            : Especialidad::latest()->paginate($perPage);

        return view('especialidades.especialidad.index', compact('especialidades'));
    }

    public function create()
    {
        return view('especialidades.especialidad.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'descripcion' => 'required|string|max:255',
        ]);

        Especialidad::create($validated);

        return redirect()->route('especialidad.index')->with('flash_message', 'Especialidad registrada correctamente.');
    }

    public function show($id)
    {
        $especialidad = Especialidad::findOrFail($id);
        return view('especialidades.especialidad.show', compact('especialidad'));
    }

    public function edit($id)
    {
        $especialidad = Especialidad::findOrFail($id);
        return view('especialidades.especialidad.edit', compact('especialidad'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'descripcion' => 'required|string|max:255',
        ]);

        $especialidad = Especialidad::findOrFail($id);
        $especialidad->update($validated);

        return redirect()->route('especialidad.index')->with('flash_message', 'Especialidad actualizada correctamente.');
    }

    public function destroy($id)
    {
        Especialidad::destroy($id);
        return redirect()->route('especialidad.index')->with('flash_message', 'Especialidad eliminada.');
    }
}
