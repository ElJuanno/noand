<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Comida
 *
 * @property $id_comida
 * @property $descripcion
 *
 * @property AsignaAlimento[] $asignaAlimentos
 * @property AsignaComida[] $asignaComidas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Comida extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id_comida', 'descripcion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function asignaAlimentos()
    {
        return $this->hasMany(\App\Models\AsignaAlimento::class, 'id_comida', 'id_asigna_c');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function asignaComidas()
    {
        return $this->hasMany(\App\Models\AsignaComida::class, 'id_comida', 'id_comida');
    }
    
}
