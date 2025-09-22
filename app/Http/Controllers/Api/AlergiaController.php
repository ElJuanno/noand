<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlergiaController extends Controller
{
    // Catálogo completo: alergias.id, alergias.descripcion
    public function catalogo()
    {
        return response()->json(
            DB::table('alergias')->select('id','descripcion')->orderBy('descripcion')->get()
        );
    }

    // IDs seleccionados por el usuario
    public function misAlergias(Request $r)
    {
        $ids = DB::table('alergia_persona')
            ->where('id_persona', $r->user()->id)
            ->pluck('alergia_id');

        return response()->json($ids);
    }

    // Reemplaza selección: Body { "ids":[1,3,7] }
    public function guardar(Request $r)
    {
        $ids = $r->validate(['ids'=>'array'])['ids'] ?? [];
        $pid = $r->user()->id;

        DB::transaction(function () use ($pid, $ids) {
            DB::table('alergia_persona')->where('id_persona',$pid)->delete();

            if (!empty($ids)) {
                $now = now();
                $rows = array_map(fn($aid)=>[
                    'id_persona'=>$pid,
                    'alergia_id'=>$aid,
                    'created_at'=>$now,
                    'updated_at'=>$now,
                ], $ids);

                DB::table('alergia_persona')->insert($rows);
            }
        });

        return response()->json(['ok'=>true]);
    }
}
