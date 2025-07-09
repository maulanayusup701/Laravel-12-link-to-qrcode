<?php

use App\Http\Controllers\GenerateController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::controller(GenerateController::class)->group(function () {
    Route::get('/link', 'link');
    Route::post('/link', 'store')->name('link.store');
});
