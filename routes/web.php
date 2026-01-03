<?php

use App\Http\Controllers\EquipoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('inicio');
})->name('inicio');;

Route::get('/partido', function () {
    return view('partido');
})->name('partido');

Route::get('/tablas', function () {
    return view('tablas');
})->name('tablas');

// Route::get('/equipos', function () {
//     return view('equipos');
// })->name('equipos');

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
