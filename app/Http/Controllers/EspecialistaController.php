<?php

namespace App\Http\Controllers;

use App\Models\Especialista;
use App\Models\Persona;
use App\Models\Especialidad;
use App\Models\Institucion;
use Illuminate\Http\Request;

class EspecialistaController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        $especialistas = !empty($keyword)
            ? Especialista::where('matricula', 'LIKE', "%$keyword%")->latest()->paginate($perPage)
            : Especialista::latest()->paginate($perPage);

        return view('especialistas.especialista.index', compact('especialistas'));
    }

    public function create()
    {
        $personas = Persona::all();
        $especialidades = Especialidad::all();
        $instituciones = Institucion::all();

        return view('especialistas.especialista.create', compact('personas', 'especialidades', 'instituciones'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_persona' => 'required|integer|exists:personas,id',
            'matricula' => 'nullable|string|max:255',
            'id_especialidad' => 'nullable|integer|exists:especialidads,id',
            'id_institucion' => 'nullable|integer|exists:institucions,id',
        ]);

        Especialista::create($validated);

        return redirect()->route('especialista.index')->with('flash_message', 'Especialista registrado correctamente.');
    }

    public function show($id)
    {
        $especialista = Especialista::findOrFail($id);
        return view('especialistas.especialista.show', compact('especialista'));
    }

    public function edit($id)
    {
        $especialista = Especialista::findOrFail($id);
        $personas = Persona::all();
        $especialidades = Especialidad::all();
        $instituciones = Institucion::all();

        return view('especialistas.especialista.edit', compact('especialista', 'personas', 'especialidades', 'instituciones'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_persona' => 'required|integer|exists:personas,id',
            'matricula' => 'nullable|string|max:255',
            'id_especialidad' => 'nullable|integer|exists:especialidads,id',
            'id_institucion' => 'nullable|integer|exists:institucions,id',
        ]);

        $especialista = Especialista::findOrFail($id);
        $especialista->update($validated);

        return redirect()->route('especialista.index')->with('flash_message', 'Especialista actualizado correctamente.');
    }

    public function destroy($id)
    {
        Especialista::destroy($id);
        return redirect()->route('especialista.index')->with('flash_message', 'Especialista eliminado.');
    }
}
