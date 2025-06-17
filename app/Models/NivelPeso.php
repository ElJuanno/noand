<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NivelPeso extends Model
{
    protected $table = 'nivel_pesos';

    protected $fillable = [
        'descripcion',
    ];

    public function medidasAntropometricas()
    {
        return $this->hasMany(MedidaAntropometrica::class, 'id_nivel_p');
    }
}
