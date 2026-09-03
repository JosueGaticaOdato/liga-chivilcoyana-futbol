<?php

use App\Http\Controllers\Admin\AdminClubController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminEquipoController;
use App\Http\Controllers\Admin\AdminPartidoController;
use App\Http\Controllers\Admin\AdminTorneoController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        // DASHBOARD
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('index');

        // TORNEOS
        Route::resource('torneos', AdminTorneoController::class)->except(['show']);

        // PARTIDOS
        Route::resource('partidos', AdminPartidoController::class)->except(['show']);

        // CLUBES
        Route::resource('clubes', AdminClubController::class)->except(['show']);

        // EQUIPOS
        Route::resource('equipos', AdminEquipoController::class)->except(['show']);
    });
