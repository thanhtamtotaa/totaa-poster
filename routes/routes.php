<?php

use Illuminate\Support\Facades\Route;
use Totaa\TotaaPoster\Http\Controllers\PosterController;

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

Route::middleware(['web', 'auth', 'CheckAccount'])->group(function () {

    //Route Poster
    Route::redirect('poster', '/', 301);
    Route::group(['prefix' => 'poster'], function () {
        Route::get('canhan',  [PosterController::class, 'canhan'])->name('poster.canhan');
        Route::get('nhom',  [PosterController::class, 'nhom'])->name('poster.nhom');
    });

});
