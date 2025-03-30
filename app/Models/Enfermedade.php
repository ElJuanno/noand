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
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id_enfermedad', 'descripcion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function asignaPadecimientos()
    {
        return $this->hasMany(\App\Models\AsignaPadecimiento::class, 'id_enfermedad', 'id_enfermedad');
    }
    
}
