<?php

use App\Http\Controllers\GenerateController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });


// Redirect root "/" ke /link
Route::redirect('/', '/link');

// Redirect semua rute tak dikenal ke /link (fallback)
Route::fallback(function () {
    return redirect('/link');
});

Route::controller(GenerateController::class)->group(function () {
    Route::get('/link', 'link');
    Route::post('/link', 'generateQR')->name('link.store');
});
    