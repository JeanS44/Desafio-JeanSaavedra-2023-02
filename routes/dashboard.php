<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;

Route::get('/dashboard', DashboardController::class)
    ->name('dashboard.index')
    ->middleware(['auth', 'verified']);
