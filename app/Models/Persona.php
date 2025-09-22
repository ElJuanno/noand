<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Persona extends Authenticatable
{
    use HasApiTokens;

    protected $table = 'personas';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'apellido_p',
        'apellido_m',
        'sexo',
        'curp',
        'correo',
        'contrasena',
    ];

    protected $hidden = ['contrasena'];
// app/Models/Persona.php
public function alergias()
    {
        return $this->belongsToMany(
            Alergia::class,      // modelo relacionado
            'alergia_persona',   // tabla pivote
            'id_persona',        // FK local en pivote
            'alergia_id'         // FK relacionada en pivote
        )->withTimestamps();
    }

    public function getAuthPassword() { return $this->contrasena; }
    public function getAuthIdentifierName() { return 'id'; }
}
