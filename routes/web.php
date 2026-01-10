<?php

use App\Http\Controllers\EquipoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\PartidoController;
use App\Http\Controllers\TorneoController;
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
