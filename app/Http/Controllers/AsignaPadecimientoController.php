<?php

namespace App\Http\Controllers;

use App\Models\AsignaPadecimiento;
use App\Models\Usuario;
use App\Models\Enfermedad;
use Illuminate\Http\Request;

class AsignaPadecimientoController extends Controller
{
    public function index()
    {
        $asignaciones = AsignaPadecimiento::latest()->paginate(25);
        return view('asigna_padecimientos.asigna_padecimiento.index', compact('asignaciones'));
    }

    public function create()
    {
        $usuarios = Usuario::all();
        $enfermedades = Enfermedad::all();
        return view('asigna_padecimientos.asigna_padecimiento.create', compact('usuarios', 'enfermedades'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_usuario' => 'required|exists:usuarios,id',
            'id_enfermedad' => 'required|exists:enfermedads,id',
        ]);

        AsignaPadecimiento::create($validated);
        return redirect()->route('asigna_padecimiento.index')->with('flash_message', 'Asignación registrada correctamente.');
    }

    public function show($id)
    {
        $asignacion = AsignaPadecimiento::findOrFail($id);
        return view('asigna_padecimientos.asigna_padecimiento.show', compact('asignacion'));
    }

    public function edit($id)
    {
        $asignacion = AsignaPadecimiento::findOrFail($id);
        $usuarios = Usuario::all();
        $enfermedades = Enfermedad::all();
        return view('asigna_padecimientos.asigna_padecimiento.edit', compact('asignacion', 'usuarios', 'enfermedades'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_usuario' => 'required|exists:usuarios,id',
            'id_enfermedad' => 'required|exists:enfermedads,id',
        ]);

        $asignacion = AsignaPadecimiento::findOrFail($id);
        $asignacion->update($validated);
        return redirect()->route('asigna_padecimiento.index')->with('flash_message', 'Asignación actualizada correctamente.');
    }

    public function destroy($id)
    {
        AsignaPadecimiento::destroy($id);
        return redirect()->route('asigna_padecimiento.index')->with('flash_message', 'Asignación eliminada.');
    }
}
