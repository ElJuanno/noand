<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MedidaSalud;

class MedidaSaludApiController extends Controller
{
    public function index(Request $r)
    {
        $q = MedidaSalud::where('id_persona', $r->user()->id)
              ->orderByDesc('created_at');

        return response()->json([
            'ultima'    => $q->first(),
            'historial' => $q->take(50)->get(),
        ]);
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'glucosa'    => 'required|numeric|min:40|max:600',
            'presion'    => 'nullable|string|max:30',   // "120/80"
            'frecuencia' => 'nullable|numeric|min:20|max:250',
            'condicion'  => 'nullable|string|max:255',
            'edad'       => 'required|integer|min:1|max:120',
        ]);

        $data['id_persona'] = $r->user()->id;

        $row = MedidaSalud::create($data);

        return response()->json($row, 201);
    }

    public function destroy(Request $r, $id)
    {
        $row = MedidaSalud::where('id_persona',$r->user()->id)->findOrFail($id);
        $row->delete();
        return response()->json([], 204);
    }
}
