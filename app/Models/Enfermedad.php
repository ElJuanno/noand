<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enfermedad extends Model
{
    protected $table = 'enfermedads';

    protected $fillable = ['nombre'];

    public function asignaciones()
    {
        return $this->hasMany(AsignaPadecimiento::class, 'id_enfermedad');
    }
}
