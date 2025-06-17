<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedidaSalud extends Model
{
    protected $table = 'medida_saluds'; // nombre real de tu tabla
    protected $fillable = [
        'glucosa', 'presion', 'frecuencia', 'condicion', 'edad', 'id_persona'
    ];

    public $timestamps = true;
}
