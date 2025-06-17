<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedidaAntropometrica extends Model
{
    protected $table = 'medida_antropometricas';
    protected $fillable = [
        'id_persona',
        'peso',
        'altura'
    ];

    public $timestamps = true;
}
