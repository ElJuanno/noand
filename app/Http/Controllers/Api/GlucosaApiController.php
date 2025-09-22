<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MedidaSalud;

class GlucosaApiController extends Controller
{
    /**
     * GET /api/glucosa?desde=YYYY-MM-DD&hasta=YYYY-MM-DD&limit=100
     */
    public function index(Request $r)
    {
        $uid   = $r->user()->id;
        $limit = (int) $r->query('limit', 100);

        $q = MedidaSalud::where('id_persona', $uid)
            ->whereNotNull('glucosa')
            ->orderByDesc('created_at');

        if ($r->filled('desde')) $q->whereDate('created_at', '>=', $r->query('desde'));
        if ($r->filled('hasta')) $q->whereDate('created_at', '<=', $r->query('hasta'));

        $rows = $q->take($limit)->get(['id','glucosa','presion','frecuencia','condicion','edad','created_at']);

        // Series para gráfica simple
        $labels = [];
        $values = [];
        foreach ($rows->sortBy('created_at') as $row) {
            $labels[] = $row->created_at->format('Y-m-d H:i');
            $values[] = (float) $row->glucosa;
        }

        return response()->json([
            'items'  => $rows,
            'series' => ['labels' => $labels, 'glucosa' => $values],
        ]);
    }

    /**
     * POST /api/glucosa
     * Body:
     * { "glucosa": 130, "edad": 28, "presion":"120/80", "frecuencia":72, "condicion":"Diabetes" }
     * (puedes mandar solo glucosa + edad; lo demás es opcional)
     */
    public function store(Request $r)
    {
        $data = $r->validate([
            'glucosa'    => 'required|numeric|min:40|max:600',
            'edad'       => 'required|integer|min:1|max:120',
            'presion'    => 'nullable|string|max:30',
            'frecuencia' => 'nullable|numeric|min:20|max:250',
            'condicion'  => 'nullable|string|max:255',
        ]);

        $data['id_persona'] = $r->user()->id;

        $row = MedidaSalud::create($data);

        return response()->json($row, 201);
    }

    /**
     * DELETE /api/glucosa/{id}
     */
    public function destroy(Request $r, $id)
    {
        $row = MedidaSalud::where('id_persona', $r->user()->id)
            ->whereNotNull('glucosa')
            ->findOrFail($id);

        $row->delete();

        return response()->json([], 204);
    }
}
