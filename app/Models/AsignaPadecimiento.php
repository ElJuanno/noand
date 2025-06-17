<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsignaPadecimiento extends Model
{
    protected $table = 'asigna_padecimientos';

    protected $fillable = [
        'id_usuario',
        'id_enfermedad',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function enfermedad()
    {
        return $this->belongsTo(Enfermedad::class, 'id_enfermedad');
    }
}
