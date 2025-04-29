<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Dieta
 *
 * @property $id_dieta
 * @property $id_usuario
 *
 * @property AsignaComida[] $asignaComidas
 * @property ReportesNutricionale[] $reportesNutricionales
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Dieta extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id_dieta', 'id_usuario'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function asignaComidas()
    {
        return $this->hasMany(\App\Models\AsignaComida::class, 'id_dieta', 'id_dieta');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reportesNutricionales()
    {
        return $this->hasMany(\App\Models\ReportesNutricionale::class, 'id_dieta', 'id_dieta');
    }
    
}
