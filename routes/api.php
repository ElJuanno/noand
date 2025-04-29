<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\PersonasController;
use App\Http\Controllers\Api\GrupoController;
use App\Http\Controllers\Api\EnfermedadController;
use App\Http\Controllers\Auth\RegisteredUserController;      
use App\Http\Controllers\Auth\AuthenticatedSessionController; 


Route::get('personas', [PersonasController::class, 'index']);
Route::post('personas_create', [PersonasController::class, 'store']);

Route::get('grupos', [GrupoController::class, 'index']);
Route::post('grupos_create', [GrupoController::class, 'store']);


Route::get('/students', function () {
    return 'students list';
});

// routes/api.php  (mejor en el grupo API para evitar CSRF)
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login',    [AuthenticatedSessionController::class, 'store']);
use App\Http\Controllers\Api\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user',   [AuthController::class, 'me']);
    Route::post('/logout',[AuthController::class, 'logout']);
});
