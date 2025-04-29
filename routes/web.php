<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

// Vistas (formularios)
Route::get('/login', function () {
    return view('auth.login');
})->name('login'); // 🔥 AGREGA ->name('login')

Route::get('/register', function () {
    return view('auth.register');
})->name('register'); // 🔥 AGREGA ->name('register')

// Acciones
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt'); // Opcional
Route::post('/register', [AuthController::class, 'register'])->name('register.attempt'); // Opcional

// Rutas de usuario y logout
Route::get('/user', [AuthController::class, 'me'])->name('user');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

