<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AlergiasPersonaController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // catálogo
        $alergias = DB::table('alergias')
            ->orderBy('descripcion')
            ->get();

        // seleccionadas del usuario (OJO: id_persona)
        $seleccionadas = DB::table('alergia_persona')
            ->where('id_persona', $userId)
            ->pluck('alergia_id')
            ->toArray();

        return view('pages.alergias.index', [
            'alergias'      => $alergias,
            'seleccionadas' => $seleccionadas,
            'persona'       => Auth::user(), // por si lo quieres mostrar en el encabezado
        ]);
    }

    public function store(Request $request)
    {
        $userId = Auth::id();

        $ids = $request->validate([
            'alergias'   => ['nullable','array'],
            'alergias.*' => ['integer'],
        ])['alergias'] ?? [];

        DB::transaction(function () use ($userId, $ids) {
            DB::table('alergia_persona')->where('id_persona', $userId)->delete();

            if (!empty($ids)) {
                $now  = now();
                $rows = array_map(fn($aid) => [
                    'id_persona' => $userId,
                    'alergia_id' => $aid,
                    'created_at' => $now,
                    'updated_at' => $now,
                ], $ids);

                DB::table('alergia_persona')->insert($rows);
            }
        });

        return back()->with('ok', 'Alergias actualizadas.');
    }
}
