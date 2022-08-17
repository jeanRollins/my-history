<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

//Route::post("user/create", [\App\Http\Controllers\UserController::class, 'create'])->name('create');

//Route::post("/login", [\App\Http\Controllers\LoginController::class, "login"]);

//Route::get("/loginGet", [\App\Http\Controllers\LoginController::class, "loginGet"]);

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
