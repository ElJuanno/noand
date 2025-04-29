<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Alergia
 *
 * @property $id_alergia
 * @property $descripcion
 *
 * @property AsignaPadecimiento[] $asignaPadecimientos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Alergia extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id_alergia', 'descripcion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function asignaPadecimientos()
    {
        return $this->hasMany(\App\Models\AsignaPadecimiento::class, 'id_alergia', 'id_alergia');
    }
    
}
