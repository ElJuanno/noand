<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alergia extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'alergias';

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
    protected $fillable = ['descripcion'];

// app/Models/Alergia.php
public function personas() {
    return $this->belongsToMany(\App\Models\Persona::class, 'alergia_persona', 'alergia_id', 'persona_id')->withTimestamps();
}

}
