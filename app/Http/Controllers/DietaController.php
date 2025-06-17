<?php

namespace App\Http\Controllers;

use App\Models\Dieta;
use App\Models\Usuario;
use Illuminate\Http\Request;

class DietaController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        $dietas = !empty($keyword)
            ? Dieta::where('id_usuario', 'LIKE', "%$keyword%")->latest()->paginate($perPage)
            : Dieta::latest()->paginate($perPage);

        return view('dietas.dieta.index', compact('dietas'));
    }

    public function create()
    {
        $usuarios = \App\Models\Usuario::all();
        return view('dietas.dieta.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_usuario' => 'required|integer|exists:usuarios,id',
        ]);

        \App\Models\Dieta::create($validated);

        return redirect()->route('dieta.index')->with('flash_message', 'Dieta creada correctamente.');
    }

    public function show($id)
    {
        $dieta = \App\Models\Dieta::findOrFail($id);
        return view('dietas.dieta.show', compact('dieta'));
    }

    public function edit($id)
    {
        $dieta = \App\Models\Dieta::findOrFail($id);
        $usuarios = \App\Models\Usuario::all();
        return view('dietas.dieta.edit', compact('dieta', 'usuarios'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_usuario' => 'required|integer|exists:usuarios,id',
        ]);

        $dieta = \App\Models\Dieta::findOrFail($id);
        $dieta->update($validated);

        return redirect()->route('dieta.index')->with('flash_message', 'Dieta actualizada correctamente.');
    }

    public function destroy($id)
    {
        \App\Models\Dieta::destroy($id);
        return redirect()->route('dieta.index')->with('flash_message', 'Dieta eliminada.');
    }
}
