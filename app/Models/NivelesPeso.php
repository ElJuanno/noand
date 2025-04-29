<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class NivelesPeso
 *
 * @property $id_nivel_p
 * @property $descripcion
 *
 * @property MedidasAntropometrica[] $medidasAntropometricas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class NivelesPeso extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id_nivel_p', 'descripcion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function medidasAntropometricas()
    {
        return $this->hasMany(\App\Models\MedidasAntropometrica::class, 'id_nivel_p', 'id_nivel_p');
    }
    
}
