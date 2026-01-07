<?php

use App\Http\Controllers\EquipoController;
use App\Http\Controllers\PartidoController;
use App\Http\Controllers\TorneoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('inicio');
})->name('inicio');

Route::get('/noticias', function () {
    return view('noticias');
})->name('noticias');

Route::get('/reglamento', function () {
    return view('reglamento');
})->name('reglamento');

//Equipos
//Route::resource('equipos', EquipoController::class);
Route::get('/equipos', [EquipoController::class, 'index'])->name('equipos.index');
Route::get('/equipos/{equipo:slug}', [EquipoController::class, 'show'])
    ->name('equipos.show');

//Tablas
Route::get('/torneos', [TorneoController::class, 'index'])
    ->name('torneos.index');

Route::get('/torneos/{torneo:slug}', [TorneoController::class, 'torneo'])
    ->name('torneos.torneo');

Route::get('/torneos/{torneo:slug}/tabla', [TorneoController::class, 'tabla'])
->name('torneos.tabla');

Route::get('/torneos/{torneo:slug}/partidos', [TorneoController::class, 'partidos'])
->name('torneos.partidos');

//Partidos
Route::get('/partidos', [PartidoController::class, 'index'])
    ->name('partidos.index');
