<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especialista extends Model
{
    protected $table = 'especialistas';

    protected $fillable = [
        'id_persona',
        'matricula',
        'id_especialidad',
        'id_institucion',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'id_especialidad');
    }

    public function institucion()
    {
        return $this->belongsTo(Institucion::class, 'id_institucion');
    }
}
