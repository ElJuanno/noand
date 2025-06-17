<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = 'grupos';

    protected $fillable = [
        'descripcion',
    ];

    public function asignaciones()
    {
        return $this->hasMany(AsignaGrupo::class, 'id_grupo');
    }
}
