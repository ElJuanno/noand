<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Ruta para la vista de Alergia
Route::get('/alergias', function () {
    return view('alergia.index');
});

// Ruta para la vista de Comida
Route::get('/comidas', function () {
    return view('comida.index');
});

// Ruta para la vista de Dieta
Route::get('/dietas', function () {
    return view('dieta.index');
});

// Ruta para la vista de Direccione
Route::get('/direcciones', function () {
    return view('direccione.index');
});

// Ruta para la vista de Enfermedade
Route::get('/enfermedades', [EnfermedadeController::class, 'index'])->name('enfermedades.index');

// Ruta para la vista de Especialidade
Route::get('/especialidades', function () {
    return view('especialidade.index');
});

// Ruta para la vista de Grupo
Route::get('/grupos', function () {
    return view('grupo.index');
});

// Ruta para la vista de Grupos Alimentario
Route::get('/grupos-alimentarios', function () {
    return view('grupos-alimentario.index');
});

// Ruta para la vista de Medidas de Salud
Route::get('/medidas-salud', function () {
    return view('medidas-salud.index');
});

// Ruta para la vista de Niveles de Peso
Route::get('/niveles-peso', function () {
    return view('niveles-peso.index');
});

// Ruta para la vista de Periodo
Route::get('/periodos', function () {
    return view('periodo.index');
});

// Ruta para la vista de Persona
Route::get('/personas', function () {
    return view('persona.index');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
