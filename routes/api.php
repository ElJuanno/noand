<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\PersonasController;
use App\Http\Controllers\Api\GrupoController;
use App\Http\Controllers\Api\EnfermedadController;


Route::get('personas', [PersonasController::class, 'index']);
Route::post('personas_create', [PersonasController::class, 'store']);

Route::get('grupos', [GrupoController::class, 'index']);
Route::post('grupos_create', [GrupoController::class, 'store']);

Route::get('enfermedades', [EnfermedadController::class, 'index']);
Route::post('enfermedades_create', [EnfermedadController::class, 'store']);


Route::get('/students', function () {
    return 'students list';
});
