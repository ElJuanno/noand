<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    protected $table = 'seguimientos';

    protected $fillable = [
        'id_persona',
        'comida',
        'fecha',
        'notas',
    ];

    public $timestamps = true;
    public function comida()
    {
        return $this->belongsTo(Comida::class, 'id_comida');
    }

}
