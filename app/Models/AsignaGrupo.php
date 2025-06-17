<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsignaGrupo extends Model
{
    protected $table = 'asigna_grupos';

    protected $fillable = [
        'id_usuario',
        'id_grupo',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'id_grupo');
    }
}
