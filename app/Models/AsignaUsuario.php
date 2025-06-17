<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsignaUsuario extends Model
{
    protected $table = 'asigna_usuarios';

    protected $fillable = [
        'id_asigna_g',
        'id_usuario',
    ];

    public function grupoAsignado()
    {
        return $this->belongsTo(AsignaGrupo::class, 'id_asigna_g');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}
