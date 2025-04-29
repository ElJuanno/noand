<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Especialidade
 *
 * @property $id_especialidad
 * @property $descripcion
 *
 * @property Especialista[] $especialistas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Especialidade extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id_especialidad', 'descripcion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function especialistas()
    {
        return $this->hasMany(\App\Models\Especialista::class, 'id_especialidad', 'id_especialidad');
    }
    
}
