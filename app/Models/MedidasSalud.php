<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MedidasSalud
 *
 * @property $id_medida_s
 * @property $descripcion
 *
 * @property Seguimiento[] $seguimientos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class MedidasSalud extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id_medida_s', 'descripcion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seguimientos()
    {
        return $this->hasMany(\App\Models\Seguimiento::class, 'id_medida_s', 'id_medida_s');
    }
    
}
