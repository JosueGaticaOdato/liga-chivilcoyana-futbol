<?php

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

Route::get('/equipos', function () {
    return view('equipos');
})->name('equipos');

Route::get('/noticias', function () {
    return view('noticias');
})->name('noticias');
