<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Grupo
 *
 * @property $id_grupo
 * @property $descripcion
 *
 * @property AsignaGrupo[] $asignaGrupos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Grupo extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id_grupo', 'descripcion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function asignaGrupos()
    {
        return $this->hasMany(\App\Models\AsignaGrupo::class, 'id_grupo', 'id_grupo');
    }
    
}
