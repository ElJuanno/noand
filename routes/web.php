<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\LoginPersonaController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\AlergiaController;
use App\Http\Controllers\AlimentoController;
use App\Http\Controllers\AsignaAlimentoController;
use App\Http\Controllers\AsignaComidaController;
use App\Http\Controllers\AsignaGrupoController;
use App\Http\Controllers\AsignaPadecimientoController;
use App\Http\Controllers\AsignaUsuarioController;
use App\Http\Controllers\ComidaController;
use App\Http\Controllers\DietaController;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\EnfermedadController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\EspecialistaController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\GrupoAlimentoController;
use App\Http\Controllers\InstitucionController;
use App\Http\Controllers\MedidaAntropometricaController;
use App\Http\Controllers\MedidaSaludController;
use App\Http\Controllers\NivelPesoController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\ReporteNutricionalController;
use App\Http\Controllers\SeguimientoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\SaludController;

// ==================== HOME ====================
Route::get('/', function () {
    return view('home');
})->name('home');

// ==================== PERFIL ====================
Route::get('/perfil', [PerfilController::class, 'edit'])->middleware('auth')->name('perfil');
Route::post('/perfil', [PerfilController::class, 'update'])->middleware('auth')->name('perfil.update');

// ==================== MEDIDAS DE SALUD (registro personalizado) ====================
Route::get('/medidas-salud/registrar', [MedidaSaludController::class, 'create'])
    ->middleware('auth')->name('medidas.salud.create');
Route::post('/medidas-salud/registrar', [MedidaSaludController::class, 'store'])
    ->middleware('auth')->name('medidas.salud.store');

// ==================== AUTENTICACIÓN ====================

// Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login-persona', [LoginPersonaController::class, 'login'])->name('login.personal');

// Registro
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::post('/registrar-persona', [PersonaController::class, 'store'])->name('registro.personal');

// Logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('home');
})->name('logout');

// Debug Auth (prueba rápida)
Route::get('/debug-auth', function() {
    return Auth::check() ? Auth::user()->nombre : 'No logueado';
});

// ==================== PANEL PRINCIPAL ====================
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// ==================== REGISTRO DE SALUD ADICIONAL ====================
Route::get('/registro-salud', [SaludController::class, 'create'])->middleware('auth')->name('salud.create');
Route::post('/registro-salud', [SaludController::class, 'store'])->middleware('auth')->name('salud.store');

// ==================== RECURSOS CRUD PRINCIPALES ====================
Route::resources([
    'alimentos' => AlimentoController::class,
    'asigna-alimentos' => AsignaAlimentoController::class,
    'asigna-comidas' => AsignaComidaController::class,
    'asigna-grupos' => AsignaGrupoController::class,
    'asigna-padecimientos' => AsignaPadecimientoController::class,
    'asigna-usuarios' => AsignaUsuarioController::class,
    'comidas' => ComidaController::class,
    'dietas' => DietaController::class,
    'direcciones' => DireccionController::class,
    'enfermedades' => EnfermedadController::class,
    'especialidades' => EspecialidadController::class,
    'especialistas' => EspecialistaController::class,
    'grupos' => GrupoController::class,
    'grupos-alimentos' => GrupoAlimentoController::class,
    'instituciones' => InstitucionController::class,
    'medidas-antropometricas' => MedidaAntropometricaController::class,
    'medidas-salud' => MedidaSaludController::class,
    'niveles-peso' => NivelPesoController::class,
    'personas' => PersonaController::class,
    'periodos' => PeriodoController::class,
    'reportes-nutricionales' => ReporteNutricionalController::class,
    'seguimientos' => SeguimientoController::class,
    'usuarios' => UsuarioController::class,
]);

//new web.php (sin organizar)
use App\Http\Controllers\PlanAlimenticioController;

Route::get('/plan-alimenticio', [PlanAlimenticioController::class, 'show'])
    ->middleware('auth')->name('plan.alimenticio');

use App\Http\Controllers\PlanesAlimenticioController;
// Página NUEVA: plan semanal (3 o 4 tiempos) — ruta principal
Route::get('/planesalimenticio/{id?}', [PlanesAlimenticioController::class, 'show'])
    ->name('planesalimenticio.show');

// ALIAS opcionales para que no falle si algún Blade viejo quedó con otros nombres
Route::get('/plan/{id?}', [PlanesAlimenticioController::class, 'show'])->name('plan.show');
Route::get('/planes/{id?}', [PlanesAlimenticioController::class, 'show'])->name('planes.show');
Route::get('/planes/alimenticio/{id?}', [PlanesAlimenticioController::class, 'show'])->name('planes.alimenticio');
Route::post('/comidas/seguir', [ComidaController::class, 'store'])->name('comida.store');

Route::get('/registro-comida', [ComidaController::class, 'create'])
    ->middleware('auth')->name('comida.create');

Route::post('/registro-comida', [ComidaController::class, 'store'])
    ->middleware('auth')->name('comida.store');

Route::post('/seguimientos/registrar', [SeguimientoController::class, 'store'])->middleware('auth')->name('seguimientos.store');

// routes/web.php
use App\Http\Controllers\AlergiasPersonaController;

Route::middleware(['auth'])->group(function () {
    Route::get('/alergias',  [AlergiasPersonaController::class, 'index'])->name('alergias.index');
    Route::post('/alergias', [AlergiasPersonaController::class, 'store'])->name('alergias.store');
});
