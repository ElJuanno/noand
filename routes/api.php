<?php

use App\Http\Controllers\Api\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas con Sanctum o middleware auth:sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/perfil', [AuthController::class, 'perfil']);
    // Otras rutas protegidas
});
use App\Http\Controllers\Api\ProfileController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/profile', [ProfileController::class, 'update']);
    Route::post('/logout', [ProfileController::class, 'logout']);
});
use App\Http\Controllers\Api\AlimentoController;

Route::middleware('auth:sanctum')->get('/alimentos', [AlimentoController::class, 'index']);
use App\Http\Controllers\Api\ComidaController;

Route::middleware('auth:sanctum')->get('/comidas', [ComidaController::class, 'index']);
Route::middleware('auth:sanctum')->post('/comidas', [ComidaController::class, 'store']);

use App\Http\Controllers\Api\MedidaSaludController;

Route::middleware('auth:sanctum')->get('/medidas-salud', [MedidaSaludController::class, 'index']);
use App\Http\Controllers\Api\PlanAlimenticioController;

Route::middleware('auth:sanctum')->get('/plan-alimenticio', [PlanAlimenticioController::class, 'show']);

Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'perfil']);
use App\Http\Controllers\Api\PerfilController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/perfil', [PerfilController::class, 'show']);
    Route::put('/perfil', [PerfilController::class, 'update']);
});
use App\Http\Controllers\Api\MedidaSaludApiController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/medidas-salud', [MedidaSaludApiController::class, 'show']);
    Route::post('/medidas-salud', [MedidaSaludApiController::class, 'store']);
});
use App\Http\Controllers\Api\PlanAlimenticioApiController;

Route::middleware('auth:sanctum')->get('/plan', [PlanAlimenticioApiController::class, 'show']);
use App\Http\Controllers\Api\ComidaApiController;

Route::middleware('auth:sanctum')->post('/comida/registrar', [ComidaApiController::class, 'registrar']);
use App\Http\Controllers\Api\SeguimientoApiController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/seguimientos/hoy', [SeguimientoApiController::class, 'resumenDiario']);
    Route::get('/seguimientos/semana', [SeguimientoApiController::class, 'graficaSemana']);
    Route::get('/seguimientos/horas', [SeguimientoApiController::class, 'graficaHora']);
});
