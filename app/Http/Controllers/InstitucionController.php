<?php

namespace App\Http\Controllers;

use App\Models\Institucion;
use App\Models\Direccion;
use Illuminate\Http\Request;

class InstitucionController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        $instituciones = !empty($keyword)
            ? Institucion::where('nombre', 'LIKE', "%$keyword%")->latest()->paginate($perPage)
            : Institucion::latest()->paginate($perPage);

        return view('instituciones.institucion.index', compact('instituciones'));
    }

    public function create()
    {
        $direcciones = Direccion::all();
        return view('instituciones.institucion.create', compact('direcciones'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'id_direccion' => 'nullable|integer|exists:direccions,id',
        ]);

        Institucion::create($validated);

        return redirect()->route('institucion.index')->with('flash_message', 'Institución registrada correctamente.');
    }

    public function show($id)
    {
        $institucion = Institucion::findOrFail($id);
        return view('instituciones.institucion.show', compact('institucion'));
    }

    public function edit($id)
    {
        $institucion = Institucion::findOrFail($id);
        $direcciones = Direccion::all();
        return view('instituciones.institucion.edit', compact('institucion', 'direcciones'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'id_direccion' => 'nullable|integer|exists:direccions,id',
        ]);

        $institucion = Institucion::findOrFail($id);
        $institucion->update($validated);

        return redirect()->route('institucion.index')->with('flash_message', 'Institución actualizada correctamente.');
    }

    public function destroy($id)
    {
        Institucion::destroy($id);
        return redirect()->route('institucion.index')->with('flash_message', 'Institución eliminada.');
    }
}
