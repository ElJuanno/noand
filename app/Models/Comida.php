<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comida extends Model
{
    protected $table = 'comidas';

    protected $fillable = ['nombre', 'horario', 'calorias', 'azucar', 'carbohidratos'];


    public $timestamps = true;
    public function seguimientos()
    {
        return $this->hasMany(Seguimiento::class, 'id_comida');
    }

}
