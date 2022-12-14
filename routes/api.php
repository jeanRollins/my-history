<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

*/
//Route::post("/login", [\App\Http\Controllers\LoginController::class, 'login']);
//Route::apiResource('login', \App\Http\Controllers\LoginController::class);

Route::post('login', [\App\Http\Controllers\LoginController::class,'index'])->name('login.index');

//Route::post('getUserApplications', [\App\Http\Controllers\UserController::class ,'getUserApplications'])->name('user.getUserApplications');

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', '\App\Http\Controllers\AuthController@login');
    Route::post('logout', '\App\Http\Controllers\AuthController@logout');
    Route::post('refresh', '\App\Http\Controllers\AuthController@refresh');
    Route::post('me', '\App\Http\Controllers\AuthController@me');
    Route::post('validateToken', '\App\Http\Controllers\AuthController@validateToken');
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'user'

], function ($router) {
    Route::post('getUserApplications', '\App\Http\Controllers\UserController@getUserApplications');
});

//Auth::routes();
