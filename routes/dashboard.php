<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\SongController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\AlbumController;
use App\Http\Controllers\Dashboard\GenreController;
use App\Http\Controllers\Dashboard\ArtistController;
use App\Http\Controllers\Dashboard\UserSongController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\SongGenreController;
use App\Http\Controllers\Dashboard\PermissionController;

Route::get('/dashboard', DashboardController::class)
    ->name('dashboard.index')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/users', [UserController::class, 'index'])
    ->name('users.index')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/albums', [AlbumController::class, 'index'])
    ->name('albums.index')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/artists', [ArtistController::class, 'index'])
    ->name('artists.index')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/genres', [GenreController::class, 'index'])
    ->name('genres.index')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/songs', [SongController::class, 'index'])
    ->name('songs.index')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/songs-genres', [SongGenreController::class, 'index'])
    ->name('songsgenres.index')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/users-songs', [UserSongController::class, 'index'])
    ->name('userssongs.index')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/roles', [RoleController::class, 'index'])
    ->name('roles.index')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/permissions', [PermissionController::class, 'index'])
    ->name('permissions.index')
    ->middleware(['auth', 'verified']);
