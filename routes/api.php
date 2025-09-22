<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\AlergiaController;
use App\Http\Controllers\Api\MedidaSaludApiController;
use App\Http\Controllers\Api\GlucosaApiController;
use App\Http\Controllers\Api\ComidaApiController;
use App\Http\Controllers\Api\PlanAlimenticioApiController;

// Diagnóstico rápido
Route::get('/ping', fn() => response()->json(['ok'=>true]));

// Público
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

// Protegido con Sanctum
Route::middleware('auth:sanctum')->group(function () {

  // Sesión / Perfil
  Route::get('/perfil',  [AuthController::class, 'perfil']);
  Route::put('/perfil',  [ProfileController::class, 'update']);
  Route::post('/logout', [AuthController::class, 'logout']);

  // Alergias
  Route::get('/alergenos', [AlergiaController::class, 'catalogo']);
  Route::get('/alergias',  [AlergiaController::class, 'misAlergias']);
  Route::post('/alergias', [AlergiaController::class, 'guardar']); // Body: { "ids":[1,3,7] }

  // Medidas de salud
  Route::get('/medidas',               [MedidaSaludApiController::class, 'index']);
  Route::post('/medidas',              [MedidaSaludApiController::class, 'store']);
  Route::delete('/medidas/{id}',       [MedidaSaludApiController::class, 'destroy']);

 // G L U C O S A
    Route::get('/glucosa',          [GlucosaApiController::class, 'index']);
    Route::post('/glucosa',         [GlucosaApiController::class, 'store']);
    Route::delete('/glucosa/{id}',  [GlucosaApiController::class, 'destroy']);

    // C O M I D A S  (seguimientos)
    Route::get('/comidas',                [ComidaApiController::class, 'index']);
    Route::post('/comidas',               [ComidaApiController::class, 'store']);
    Route::delete('/comidas/{id}',        [ComidaApiController::class, 'destroy']); // id de seguimiento

    // P L A N E S
    Route::post('/plan/recetas',   [PlanAlimenticioApiController::class, 'recetas']);   // modo=agrupadas
    Route::post('/plan/semanal',   [PlanAlimenticioApiController::class, 'semanal']);   // comidas_por_dia=3|4
});
