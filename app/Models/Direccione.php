<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Direccione
 *
 * @property $id_direccion
 * @property $descripcion
 * @property $cp
 * @property $referencia
 *
 * @property Institucione[] $instituciones
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Direccione extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id_direccion', 'descripcion', 'cp', 'referencia'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function instituciones()
    {
        return $this->hasMany(\App\Models\Institucione::class, 'id_direccion', 'id_direccion');
    }
    
}
