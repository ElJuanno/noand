<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GruposAlimentario
 *
 * @property $id_grupo_a
 * @property $descripcion
 *
 * @property Alimento[] $alimentos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class GruposAlimentario extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id_grupo_a', 'descripcion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function alimentos()
    {
        return $this->hasMany(\App\Models\Alimento::class, 'id_grupo_a', 'id_grupo_a');
    }
    
}
