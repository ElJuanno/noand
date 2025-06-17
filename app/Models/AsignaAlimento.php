<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsignaAlimento extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'asigna_alimentos';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_comida', 'id_alimento'];

    
}
