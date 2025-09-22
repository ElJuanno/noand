<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComidaApiController extends Controller
{
    /**
     * GET /api/comidas?desde=YYYY-MM-DD&hasta=YYYY-MM-DD
     * Lista consumos (seguimientos) del usuario con info de la comida.
     */
    public function index(Request $r)
    {
        $uid = $r->user()->id;
        $q = DB::table('seguimientos')
            ->join('comidas', 'seguimientos.id_comida', '=', 'comidas.id')
            ->where('seguimientos.id_persona', $uid);

        if ($r->filled('desde')) $q->whereDate('seguimientos.fecha', '>=', $r->query('desde'));
        if ($r->filled('hasta')) $q->whereDate('seguimientos.fecha', '<=', $r->query('hasta'));

        $rows = $q->orderByDesc('seguimientos.fecha')->orderByDesc('seguimientos.id')
            ->get([
                'seguimientos.id',
                'seguimientos.fecha',
                'seguimientos.notas',
                'comidas.nombre',
                'comidas.horario',
                'comidas.calorias',
                'comidas.azucar',
                'comidas.carbohidratos',
            ]);

        // Resumen por día (cal, azucar, carb)
        $resumen = [];
        foreach ($rows as $r0) {
            $d = (string) $r0->fecha;
            $resumen[$d] = $resumen[$d] ?? ['calorias'=>0,'azucar'=>0,'carbohidratos'=>0];
            $resumen[$d]['calorias']      += (float) $r0->calorias;
            $resumen[$d]['azucar']        += (float) $r0->azucar;
            $resumen[$d]['carbohidratos'] += (float) $r0->carbohidratos;
        }

        return response()->json([
            'items'   => $rows,
            'resumen' => $resumen,
        ]);
    }

    /**
     * POST /api/comidas
     * Body:
     * {
     *   "nombre":"Ensalada verde","hora":"13:00",
     *   "calorias":220,"azucar":3,"carbohidratos":18,
     *   "fecha":"2025-09-22", "notas":"opcional"
     * }
     */
    public function store(Request $r)
    {
        $data = $r->validate([
            'nombre'        => 'required|string|max:255',
            'hora'          => 'required|string|max:10',
            'calorias'      => 'required|numeric|min:0',
            'azucar'        => 'required|numeric|min:0',
            'carbohidratos' => 'required|numeric|min:0',
            'fecha'         => 'nullable|date',
            'notas'         => 'nullable|string|max:500',
        ]);

        // Buscar o crear la comida por nombre
        $comida = DB::table('comidas')->where('nombre', $data['nombre'])->first();
        if (!$comida) {
            $comidaId = DB::table('comidas')->insertGetId([
                'nombre'        => $data['nombre'],
                'horario'       => $data['hora'],
                'calorias'      => $data['calorias'],
                'azucar'        => $data['azucar'],
                'carbohidratos' => $data['carbohidratos'],
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        } else {
            $comidaId = $comida->id;
        }

        // Crear seguimiento para el usuario
        $sid = DB::table('seguimientos')->insertGetId([
            'id_persona' => $r->user()->id,
            'id_comida'  => $comidaId,
            'fecha'      => $data['fecha'] ?? now()->toDateString(),
            'notas'      => $data['notas'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $seguimiento = DB::table('seguimientos')
            ->join('comidas', 'seguimientos.id_comida', '=', 'comidas.id')
            ->where('seguimientos.id', $sid)
            ->first([
                'seguimientos.id',
                'seguimientos.fecha',
                'seguimientos.notas',
                'comidas.nombre',
                'comidas.horario',
                'comidas.calorias',
                'comidas.azucar',
                'comidas.carbohidratos',
            ]);

        return response()->json($seguimiento, 201);
    }

    /**
     * DELETE /api/comidas/{seguimiento_id}
     */
    public function destroy(Request $r, $id)
    {
        $uid = $r->user()->id;

        $row = DB::table('seguimientos')
            ->where('id', $id)
            ->where('id_persona', $uid)
            ->first();

        if (!$row) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        DB::table('seguimientos')->where('id', $id)->delete();

        return response()->json([], 204);
    }
}
