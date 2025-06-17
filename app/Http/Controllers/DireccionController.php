<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use Illuminate\Http\Request;

class DireccionController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        $direcciones = !empty($keyword)
            ? Direccion::where('descripcion', 'LIKE', "%$keyword%")->latest()->paginate($perPage)
            : Direccion::latest()->paginate($perPage);

        return view('direcciones.direccion.index', compact('direcciones'));
    }

    public function create()
    {
        return view('direcciones.direccion.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'descripcion' => 'required|string|max:255',
            'cp' => 'nullable|string|max:255',
            'referencia' => 'nullable|string',
        ]);

        Direccion::create($validated);

        return redirect()->route('direccion.index')->with('flash_message', 'Dirección registrada correctamente.');
    }

    public function show($id)
    {
        $direccion = Direccion::findOrFail($id);
        return view('direcciones.direccion.show', compact('direccion'));
    }

    public function edit($id)
    {
        $direccion = Direccion::findOrFail($id);
        return view('direcciones.direccion.edit', compact('direccion'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'descripcion' => 'required|string|max:255',
            'cp' => 'nullable|string|max:255',
            'referencia' => 'nullable|string',
        ]);

        $direccion = Direccion::findOrFail($id);
        $direccion->update($validated);

        return redirect()->route('direccion.index')->with('flash_message', 'Dirección actualizada correctamente.');
    }

    public function destroy($id)
    {
        Direccion::destroy($id);
        return redirect()->route('direccion.index')->with('flash_message', 'Dirección eliminada.');
    }
}
