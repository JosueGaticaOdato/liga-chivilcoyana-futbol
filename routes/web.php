<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     //return view('welcome');
// });

Route::Get("/",function(){
    return view("home");
});

//Get - Post - Put - Patch - Delete