<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    protected $table = 'institucions';

    protected $fillable = [
        'nombre',
        'id_direccion',
    ];

    public function direccion()
    {
        return $this->belongsTo(Direccion::class, 'id_direccion');
    }

    public function especialistas()
    {
        return $this->hasMany(Especialista::class, 'id_institucion');
    }
}
