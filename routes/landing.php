<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Landing\ArtistController;
use App\Http\Controllers\Landing\LandingController;

Route::get('/', [LandingController::class, 'index'])
    ->name('landing.index');

/* Route::get('/artist', [ArtistController::class, 'index'])
    ->name('songs.landing.index');

Route::get('/songs', [ArtistController::class, 'index'])
    ->name('songs.landing.index');

Route::get('/songs', [ArtistController::class, 'index'])
    ->name('songs.landing.index');

Route::get('/songs', [ArtistController::class, 'index'])
    ->name('songs.landing.index');
 */

Route::post('/registrar-reproduccion/{cancionId}', [LandingController::class, 'registrarReproduccion']);
Route::get('/buscar-albums', [LandingController::class, 'buscarAlbums']);
