<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrupoAlimento extends Model
{
    protected $table = 'grupo_alimentos';

    protected $fillable = ['descripcion'];

    public function alimentos()
    {
        return $this->hasMany(Alimento::class, 'id_grupo_alimento');
    }
}
