<?php

namespace App\Http\Controllers;

use App\Models\ReporteNutricional;
use App\Models\Dieta;
use App\Models\Usuario;
use App\Models\Periodo;
use Illuminate\Http\Request;

class ReporteNutricionalController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        $reportes = !empty($keyword)
            ? ReporteNutricional::where('id_usuario', 'LIKE', "%$keyword%")->latest()->paginate($perPage)
            : ReporteNutricional::latest()->paginate($perPage);

        return view('reporte_nutricionales.reporte_nutricional.index', compact('reportes'));
    }

    public function create()
    {
        $dietas = Dieta::all();
        $usuarios = Usuario::all();
        $periodos = Periodo::all();

        return view('reporte_nutricionales.reporte_nutricional.create', compact('dietas', 'usuarios', 'periodos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_dieta' => 'nullable|integer|exists:dietas,id',
            'id_usuario' => 'nullable|integer|exists:usuarios,id',
            'id_periodo' => 'nullable|integer|exists:periodos,id',
        ]);

        ReporteNutricional::create($validated);

        return redirect()->route('reporte_nutricional.index')->with('flash_message', 'Reporte registrado correctamente.');
    }

    public function show($id)
    {
        $reporte = ReporteNutricional::findOrFail($id);
        return view('reporte_nutricionales.reporte_nutricional.show', compact('reporte'));
    }

    public function edit($id)
    {
        $reporte = ReporteNutricional::findOrFail($id);
        $dietas = Dieta::all();
        $usuarios = Usuario::all();
        $periodos = Periodo::all();

        return view('reporte_nutricionales.reporte_nutricional.edit', compact('reporte', 'dietas', 'usuarios', 'periodos'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_dieta' => 'nullable|integer|exists:dietas,id',
            'id_usuario' => 'nullable|integer|exists:usuarios,id',
            'id_periodo' => 'nullable|integer|exists:periodos,id',
        ]);

        $reporte = ReporteNutricional::findOrFail($id);
        $reporte->update($validated);

        return redirect()->route('reporte_nutricional.index')->with('flash_message', 'Reporte actualizado correctamente.');
    }

    public function destroy($id)
    {
        ReporteNutricional::destroy($id);
        return redirect()->route('reporte_nutricional.index')->with('flash_message', 'Reporte eliminado.');
    }
}
