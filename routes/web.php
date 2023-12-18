<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';
require __DIR__.'/landing.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');