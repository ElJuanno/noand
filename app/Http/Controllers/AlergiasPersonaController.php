<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Alergia;
use App\Models\Persona;

class AlergiasPersonaController extends Controller
{
    public function index()
    {
        $persona = Persona::findOrFail(Auth::id());

        // Todas las alergias para listar
        $alergias = Alergia::orderBy('descripcion')->get();

        // IDs seleccionados por este usuario
        $seleccionadas = DB::table('alergia_persona')
            ->where('id_persona', $persona->id)
            ->pluck('alergia_id')
            ->toArray();

        return view('pages.alergias', compact('persona', 'alergias', 'seleccionadas'));
    }

    public function store(Request $request)
    {
        $personaId = Auth::id();

        $ids = $request->input('alergias', []);   // array de alergia_id
        if (!is_array($ids)) $ids = [];

        DB::table('alergia_persona')
            ->where('id_persona', $personaId)
            ->delete();

        if (!empty($ids)) {
            $rows = array_map(function ($id) use ($personaId) {
                return [
                    'id_persona' => $personaId,
                    'alergia_id' => (int) $id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }, $ids);

            DB::table('alergia_persona')->insert($rows);
        }

        return back()->with('ok', 'Alergias guardadas.');
    }
}
