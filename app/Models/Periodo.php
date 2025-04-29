<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Periodo
 *
 * @property $id_periodo
 * @property $fecha_i
 * @property $fecha_f
 *
 * @property ReportesNutricionale[] $reportesNutricionales
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Periodo extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id_periodo', 'fecha_i', 'fecha_f'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reportesNutricionales()
    {
        return $this->hasMany(\App\Models\ReportesNutricionale::class, 'id_periodo', 'id_periodo');
    }
    
}
