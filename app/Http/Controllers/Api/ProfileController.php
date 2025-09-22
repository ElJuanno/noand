<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MedidaAntropometrica;

class ProfileController extends Controller
{
    public function update(Request $r)
    {
        $u = $r->user();

        $data = $r->validate([
            'nombre'      => 'sometimes|string|max:255',
            'apellido_p'  => 'sometimes|string|max:255',
            'apellido_m'  => 'sometimes|string|max:255',
            'sexo'        => 'sometimes|in:H,M',
            'curp'        => 'nullable|string|max:18|unique:personas,curp,'.$u->id,
            'correo'      => 'sometimes|email|unique:personas,correo,'.$u->id,
            // antropometría:
            'peso'        => 'nullable|numeric|min:10|max:350',
            'altura'      => 'nullable|numeric|min:0.5|max:2.5',
        ]);

        // actualizar datos personales
        $u->fill($data)->save();

        // actualizar/crear antropometría (como en tu PerfilController)
        if ($r->filled('peso') || $r->filled('altura')) {
            MedidaAntropometrica::updateOrCreate(
                ['id_persona' => $u->id],
                [
                    'peso'   => $r->input('peso'),
                    'altura' => $r->input('altura'),
                ]
            );
        }

        return response()->json($u->fresh());
    }
}
