<?php

namespace App\Http\Controllers;

use App\Models\Enfermedad;
use Illuminate\Http\Request;

class EnfermedadController extends Controller
{
    public function index()
    {
        $enfermedades = Enfermedad::latest()->paginate(25);
        return view('enfermedades.enfermedad.index', compact('enfermedades'));
    }

    public function create()
    {
        return view('enfermedades.enfermedad.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        Enfermedad::create($validated);
        return redirect()->route('enfermedad.index')->with('flash_message', 'Enfermedad registrada correctamente.');
    }

    public function show($id)
    {
        $enfermedad = Enfermedad::findOrFail($id);
        return view('enfermedades.enfermedad.show', compact('enfermedad'));
    }

    public function edit($id)
    {
        $enfermedad = Enfermedad::findOrFail($id);
        return view('enfermedades.enfermedad.edit', compact('enfermedad'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $enfermedad = Enfermedad::findOrFail($id);
        $enfermedad->update($validated);
        return redirect()->route('enfermedad.index')->with('flash_message', 'Enfermedad actualizada correctamente.');
    }

    public function destroy($id)
    {
        Enfermedad::destroy($id);
        return redirect()->route('enfermedad.index')->with('flash_message', 'Enfermedad eliminada.');
    }
}
