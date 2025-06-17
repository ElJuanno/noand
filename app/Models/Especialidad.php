<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $table = 'especialidads';

    protected $fillable = [
        'descripcion',
    ];

    public function especialistas()
    {
        return $this->hasMany(Especialista::class, 'id_especialidad');
    }
}
