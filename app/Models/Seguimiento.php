<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seguimiento extends Model
{
    use HasFactory;

    protected $table = 'seguimientos';

    protected $fillable = [
        'id_persona','fecha','hora','tiempo','nombre',
        'calorias','azucar','carbohidratos','notas','metadata',
    ];

    protected $casts = [
        'fecha' => 'date',
        'metadata' => 'array',
    ];
}
