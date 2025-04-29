<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ─── Controladores API que realmente usas ───────────────────────────────
use App\Http\Controllers\Api\PersonasController;
use App\Http\Controllers\Api\GrupoController;
use App\Http\Controllers\Api\AuthController;      // ← Único para login/register

// ─── Endpoints ejemplo (Personas, Grupos) ───────────────────────────────
Route::get('personas',        [PersonasController::class, 'index']);
Route::post('personas_create',[PersonasController::class, 'store']);

Route::get('grupos',          [GrupoController::class, 'index']);
Route::post('grupos_create',  [GrupoController::class, 'store']);

Route::get('/students', function () {
    return 'students list';
});

// ─── Autenticación (solo estas líneas) ──────────────────────────────────
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user',   [AuthController::class, 'me']);
    Route::post('/logout',[AuthController::class, 'logout']);
});
