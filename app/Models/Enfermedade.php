<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Enfermedade
 *
 * @property $id_enfermedad
 * @property $descripcion
 *
 * @property AsignaPadecimiento[] $asignaPadecimientos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Enfermedade extends Model
{
    protected $table = 'enfermedades'; // opcional si ya usas nombre pluralizado
    protected $primaryKey = 'id_enfermedad';
    public $incrementing = true; // o false si no es autoincremental
    public $timestamps = false;

    protected $perPage = 20;

    protected $fillable = ['id_enfermedad', 'descripcion'];

    public function asignaPadecimientos()
    {
        return $this->hasMany(\App\Models\AsignaPadecimiento::class, 'id_enfermedad', 'id_enfermedad');
    }
}

