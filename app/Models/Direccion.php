<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $table = 'direccions'; // tabla en base sigue con 's' final

    protected $fillable = [
        'descripcion',
        'cp',
        'referencia',
    ];

    public function instituciones()
    {
        return $this->hasMany(Institucion::class, 'id_direccion');
    }
}
