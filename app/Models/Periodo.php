<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $table = 'periodos';

    protected $fillable = [
        'fecha_i',
        'fecha_f',
    ];

    public function seguimientos()
    {
        return $this->hasMany(Seguimiento::class, 'id_periodo');
    }

    public function reportesNutricionales()
    {
        return $this->hasMany(ReporteNutricional::class, 'id_periodo');
    }
}
