<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\{
    LoginPersonaController,
    PersonaController,
    AlergiaController,
    AlimentoController,
    AsignaAlimentoController,
    AsignaComidaController,
    AsignaGrupoController,
    AsignaPadecimientoController,
    AsignaUsuarioController,
    ComidaController,
    DietaController,
    DireccionController,
    EnfermedadController,
    EspecialidadController,
    EspecialistaController,
    GrupoController,
    GrupoAlimentoController,
    InstitucionController,
    MedidaAntropometricaController,
    MedidaSaludController,
    NivelPesoController,
    PeriodoController,
    ReporteNutricionalController,
    UsuarioController,
    PerfilController,
    SaludController,
    PlanAlimenticioController,
    PlanesAlimenticioController,
    AlergiasPersonaController,
    SeguimientoController
};

/*
|--------------------------------------------------------------------------
| Rutas públicas
|--------------------------------------------------------------------------
*/
Route::view('/', 'home')->name('home');

// Auth “manual” que ya tienes
Route::view('/login', 'auth.login')->name('login');
Route::post('/login-persona', [LoginPersonaController::class, 'login'])->name('login.personal');

Route::view('/register', 'auth.register')->name('register');
Route::post('/registrar-persona', [PersonaController::class, 'store'])->name('registro.personal');

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('home');
})->name('logout');

// Debug rápido
Route::get('/debug-auth', fn () => Auth::check() ? Auth::user()->nombre : 'No logueado');

/*
|--------------------------------------------------------------------------
| Rutas autenticadas
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    // Perfil
    Route::get('/perfil',  [PerfilController::class, 'edit'])->name('perfil');
    Route::post('/perfil', [PerfilController::class, 'update'])->name('perfil.update');

    // Medidas de salud (flujo simple)
    Route::get('/medidas-salud/registrar',  [MedidaSaludController::class, 'create'])->name('medidas.salud.create');
    Route::post('/medidas-salud/registrar', [MedidaSaludController::class, 'store'])->name('medidas.salud.store');

    // Registro de salud adicional
    Route::get('/registro-salud',  [SaludController::class, 'create'])->name('salud.create');
    Route::post('/registro-salud', [SaludController::class, 'store'])->name('salud.store');

    // Plan alimenticio (tu grid de recetas)
    Route::get('/plan-alimenticio', [PlanAlimenticioController::class, 'show'])->name('plan.alimenticio');

    // Planes semanales (3 o 4 tiempos)
    Route::get('/planes-alimenticio/{id?}', [PlanesAlimenticioController::class, 'show'])->name('planesalimenticio.show');
    // aliases por compatibilidad con blades viejos
    Route::get('/plan/{id?}',              [PlanesAlimenticioController::class, 'show'])->name('plan.show');
    Route::get('/planes/{id?}',            [PlanesAlimenticioController::class, 'show'])->name('planes.show');
    Route::get('/planes/alimenticio/{id?}',[PlanesAlimenticioController::class, 'show'])->name('planes.alimenticio');

    // Alergias del usuario
    Route::get('/alergias',  [AlergiasPersonaController::class, 'index'])->name('alergias.index');
    Route::post('/alergias', [AlergiasPersonaController::class, 'store'])->name('alergias.store');

    // Registro de Comidas (Seguimiento)
    Route::get('/registro-comidas',  [SeguimientoController::class, 'index'])->name('seguimiento.index');
    Route::post('/registro-comidas', [SeguimientoController::class, 'store'])->name('seguimiento.store');
    Route::delete('/registro-comidas/{seguimiento}', [SeguimientoController::class, 'destroy'])->name('seguimiento.destroy');

    /*
    |--------------------------------------------------------------------------
    | CRUDs (si son administrativos, puedes moverlos a un middleware('auth','can:admin') )
    |--------------------------------------------------------------------------
    */
    Route::resources([
        'alimentos'           => AlimentoController::class,
        'asigna-alimentos'    => AsignaAlimentoController::class,
        'asigna-comidas'      => AsignaComidaController::class,
        'asigna-grupos'       => AsignaGrupoController::class,
        'asigna-padecimientos'=> AsignaPadecimientoController::class,
        'asigna-usuarios'     => AsignaUsuarioController::class,
        'comidas'             => ComidaController::class,
        'dietas'              => DietaController::class,
        'direcciones'         => DireccionController::class,
        'enfermedades'        => EnfermedadController::class,
        'especialidades'      => EspecialidadController::class,
        'especialistas'       => EspecialistaController::class,
        'grupos'              => GrupoController::class,
        'grupos-alimentos'    => GrupoAlimentoController::class,
        'instituciones'       => InstitucionController::class,
        'medidas-antropometricas' => MedidaAntropometricaController::class,
        'medidas-salud'       => MedidaSaludController::class,
        'niveles-peso'        => NivelPesoController::class,
        'personas'            => PersonaController::class,
        'periodos'            => PeriodoController::class,
        'reportes-nutricionales'=> ReporteNutricionalController::class,
        'usuarios'            => UsuarioController::class,
    ]);
});

Route::get('/salud', [MedidaSaludController::class, 'overview'])
    ->middleware('auth')->name('salud.overview');
// RUTAS PARA EL USUARIO (mis alergias)
Route::middleware('auth')->group(function () {
    Route::get('/alergias',  [\App\Http\Controllers\AlergiasPersonaController::class, 'index'])->name('alergias.index');
    Route::post('/alergias', [\App\Http\Controllers\AlergiasPersonaController::class, 'store'])->name('alergias.store');
});

// CRUD del catálogo (admin) con prefijo y alias distintos
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('alergias', \App\Http\Controllers\AlergiaController::class);
});
