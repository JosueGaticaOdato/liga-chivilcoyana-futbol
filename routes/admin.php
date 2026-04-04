<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AdminPartidoController;
use App\Http\Controllers\admin\AdminTorneoController;
use App\Http\Controllers\admin\AdminNoticiaController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // INDEX
        Route::get('/', [AdminController::class, 'index'])->name('index');

        // PARTIDOS
        Route::resource('partidos', AdminPartidoController::class)->except(['show']);

        // TORNEOS
        Route::resource('torneos', AdminTorneoController::class)->except(['show']);

        // NOTICIAS
        Route::resource('noticias', AdminNoticiaController::class)->except(['show']);




    });
