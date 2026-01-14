<?php

use App\Http\Controllers\Admin\AdminNoticiaController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\PartidoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TorneoController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


/* ===== HOME ===== */

Route::get('/', [HomeController::class, 'index'])->name('home');

/* ===== EQUIPOS ===== */

Route::get('/equipos', [EquipoController::class, 'index'])->name('equipos.index');
Route::get('/equipos/{equipo:slug}', [EquipoController::class, 'show'])
    ->name('equipos.show');

/* ===== TABLAS ===== */

Route::get('/torneos', [TorneoController::class, 'index'])
    ->name('torneos.index');

Route::get('/torneos/{torneo:slug}', [TorneoController::class, 'torneo'])
    ->name('torneos.torneo');

Route::get('/torneos/{torneo:slug}/tabla', [TorneoController::class, 'tabla'])
    ->name('torneos.tabla');

Route::get('/torneos/{torneo:slug}/partidos', [TorneoController::class, 'partidos'])
    ->name('torneos.partidos');

Route::get(
    '/torneos/{torneo:slug}/fixture/{fecha?}',
    [TorneoController::class, 'fixture']
)->name('torneos.fixture');

/* ===== PARTIDOS ===== */

Route::get('/partidos', [PartidoController::class, 'index'])
    ->name('partidos.index');

/* ===== NOTICIAS ===== */

Route::get('/noticias', [NoticiaController::class, 'index'])
    ->name('noticias.index');

Route::get('/noticias/{noticia:slug}', [NoticiaController::class, 'show'])
    ->name('noticias.show');

Route::get('/reglamento', function () {
    return view('reglamento');
})->name('reglamento');

/* ===== LOGIN ===== */

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

Route::middleware('auth')->group(function () {
    Route::get('/perfil', [ProfileController::class, 'index'])
        ->name('perfil');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::get('/register', [RegisterController::class, 'show'])
    ->name('register');

Route::post('/register', [RegisterController::class, 'store'])
    ->name('register.store');

/* ===== ADMIN ===== */

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Route::get('/', [AdminDashboardController::class, 'index'])
        //     ->name('dashboard');

        Route::resource('noticias', AdminNoticiaController::class);
        // Route::resource('equipos', AdminEquipoController::class);
        // Route::resource('torneos', AdminTorneoController::class);
        // Route::resource('partidos', AdminPartidoController::class);
});
