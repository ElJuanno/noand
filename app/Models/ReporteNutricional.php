<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReporteNutricional extends Model
{
    protected $table = 'reporte_nutricionals';

    protected $fillable = [
        'id_dieta',
        'id_usuario',
        'id_periodo',
    ];

    public function dieta()
    {
        return $this->belongsTo(Dieta::class, 'id_dieta');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'id_periodo');
    }
}
