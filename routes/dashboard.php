<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ArtistAlbumController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\SongController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\AlbumController;
use App\Http\Controllers\Dashboard\GenreController;
use App\Http\Controllers\Dashboard\ArtistController;
use App\Http\Controllers\Dashboard\UserRoleController;
use App\Http\Controllers\Dashboard\UserSongController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\PermissionController;
use App\Http\Controllers\Dashboard\RolePermissionController;

Route::get('/dashboard', DashboardController::class)
    ->name('dashboard.index')
    ->middleware(['auth', 'verified','role:Administrador|Oyente|Artista']);

/* Ruta para Usuarios */
Route::post('/dashboard/users/{id}/update', [UserController::class, 'update'])
    ->name('users.update')
    ->middleware(['auth', 'verified']);

Route::delete('/dashboard/users/{id}/delete', [UserController::class, 'destroy'])
    ->name('users.destroy')
    ->middleware(['auth', 'verified']);

Route::post('/dashboard/users/store', [UserController::class, 'store'])
    ->name('users.store')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/users', [UserController::class, 'index'])
    ->name('users.index')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/users/add', [UserController::class, 'create'])
    ->name('users.create')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/users/{user}/show', [UserController::class, 'show'])
    ->name('users.show')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/users/{user}/edit', [UserController::class, 'edit'])
    ->name('users.edit')
    ->middleware(['auth', 'verified']);
/* Fin ruta para Usuarios */

/* Ruta para Artistas */
Route::post('/dashboard/artists/{id}/update', [ArtistController::class, 'update'])
    ->name('artists.update')
    ->middleware(['auth', 'verified']);

Route::delete('/dashboard/artists/{id}/delete', [ArtistController::class, 'destroy'])
    ->name('artists.destroy')
    ->middleware(['auth', 'verified']);

Route::post('/dashboard/artists/store', [ArtistController::class, 'store'])
    ->name('artists.store')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/artists', [ArtistController::class, 'index'])
    ->name('artists.index')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/artists/add', [ArtistController::class, 'create'])
    ->name('artists.create')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/artists/{artist}/show', [ArtistController::class, 'show'])
    ->name('artists.show')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/artists/{artist}/edit', [ArtistController::class, 'edit'])
    ->name('artists.edit')
    ->middleware(['auth', 'verified']);


/* Fin ruta para Artistas */

/* Ruta para Albums */
Route::post('/dashboard/albums/{id}/update', [AlbumController::class, 'update'])
    ->name('albums.update')
    ->middleware(['auth', 'verified']);

Route::delete('/dashboard/albums/{id}/delete', [AlbumController::class, 'destroy'])
    ->name('albums.destroy')
    ->middleware(['auth', 'verified']);

Route::post('/dashboard/albums/store', [AlbumController::class, 'store'])
    ->name('albums.store')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/albums', [AlbumController::class, 'index'])
    ->name('albums.index')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/albums/add', [AlbumController::class, 'create'])
    ->name('albums.create')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/albums/{album}/show', [AlbumController::class, 'show'])
    ->name('albums.show')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/albums/{album}/edit', [AlbumController::class, 'edit'])
    ->name('albums.edit')
    ->middleware(['auth', 'verified']);
/* Fin ruta para Albums */

/* Ruta para Géneros */
Route::post('/dashboard/genres/{id}/update', [GenreController::class, 'update'])
    ->name('genres.update')
    ->middleware(['auth', 'verified']);

Route::delete('/dashboard/genres/{id}/delete', [GenreController::class, 'destroy'])
    ->name('genres.destroy')
    ->middleware(['auth', 'verified']);

Route::post('/dashboard/genres/store', [GenreController::class, 'store'])
    ->name('genres.store')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/genres', [GenreController::class, 'index'])
    ->name('genres.index')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/genres/add', [GenreController::class, 'create'])
    ->name('genres.create')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/genres/{genre}/show', [GenreController::class, 'show'])
    ->name('genres.show')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/genres/{genre}/edit', [GenreController::class, 'edit'])
    ->name('genres.edit')
    ->middleware(['auth', 'verified']);
/* Fin ruta para Géneros */

/* Ruta para Canciones */
Route::post('/dashboard/songs/{id}/update', [SongController::class, 'update'])
    ->name('songs.update')
    ->middleware(['auth', 'verified']);

Route::delete('/dashboard/songs/{id}/delete', [SongController::class, 'destroy'])
    ->name('songs.destroy')
    ->middleware(['auth', 'verified']);

Route::post('/dashboard/songs/store/', [SongController::class, 'store'])
    ->name('songs.store')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/songs', [SongController::class, 'index'])
    ->name('songs.index')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/songs/add', [SongController::class, 'create'])
    ->name('songs.create')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/songs/{song}/show', [SongController::class, 'show'])
    ->name('songs.show')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/songs/{song}/edit', [SongController::class, 'edit'])
    ->name('songs.edit')
    ->middleware(['auth', 'verified']);
/* Fin ruta para Canciones */

/* Ruta para Roles */
Route::post('/dashboard/roles/{id}/update', [RoleController::class, 'update'])
    ->name('roles.update')
    ->middleware(['auth', 'verified']);

Route::delete('/dashboard/roles/{id}/delete', [RoleController::class, 'destroy'])
    ->name('roles.destroy')
    ->middleware(['auth', 'verified']);

Route::post('/dashboard/roles/store/', [RoleController::class, 'store'])
    ->name('roles.store')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/roles', [RoleController::class, 'index'])
    ->name('roles.index')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/roles/add', [RoleController::class, 'create'])
    ->name('roles.create')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/roles/{role}/show', [RoleController::class, 'show'])
    ->name('roles.show')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/roles/{role}/edit', [RoleController::class, 'edit'])
    ->name('roles.edit')
    ->middleware(['auth', 'verified']);
/* Fin ruta para Roles */

/* Ruta para Asignar Roles a Usuarios */
Route::post('/dashboard/usersroles/{id}/update', [UserRoleController::class, 'update'])
    ->name('usersroles.update')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/usersroles', [UserRoleController::class, 'index'])
    ->name('usersroles.index')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/usersroles/{userrole}/show', [UserRoleController::class, 'show'])
    ->name('usersroles.show')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/usersroles/{userrole}/edit', [UserRoleController::class, 'edit'])
    ->name('usersroles.edit')
    ->middleware(['auth', 'verified']);
/* Fin ruta para Asignar Roles a Usuarios */

/* Ruta para Permisos */
Route::post('/dashboard/permissions/{id}/update', [PermissionController::class, 'update'])
    ->name('permissions.update')
    ->middleware(['auth', 'verified']);

Route::delete('/dashboard/permissions/{id}/delete', [PermissionController::class, 'destroy'])
    ->name('permissions.destroy')
    ->middleware(['auth', 'verified']);

Route::post('/dashboard/permissions/store/', [PermissionController::class, 'store'])
    ->name('permissions.store')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/permissions', [PermissionController::class, 'index'])
    ->name('permissions.index')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/permissions/add', [PermissionController::class, 'create'])
    ->name('permissions.create')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/permissions/{permission}/show', [PermissionController::class, 'show'])
    ->name('permissions.show')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/permissions/{permission}/edit', [PermissionController::class, 'edit'])
    ->name('permissions.edit')
    ->middleware(['auth', 'verified']);
/* Fin ruta para Permisos */

/* Ruta para Asignar Permisos a Roles */
Route::post('/dashboard/rolespermissions/{id}/update', [RolePermissionController::class, 'update'])
    ->name('rolespermissions.update')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/rolespermissions', [RolePermissionController::class, 'index'])
    ->name('rolespermissions.index')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/rolespermissions/{rolepermission}/show', [RolePermissionController::class, 'show'])
    ->name('rolespermissions.show')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/rolespermissions/{rolepermission}/edit', [RolePermissionController::class, 'edit'])
    ->name('rolespermissions.edit')
    ->middleware(['auth', 'verified']);
/* Fin ruta para Asignar Permisos a Roles */











Route::get('/dashboard/permissions', [PermissionController::class, 'index'])
    ->name('permissions.index')
    ->middleware(['auth', 'verified']);

Route::get('/dashboard/users-songs', [UserSongController::class, 'index'])
    ->name('userssongs.index')
    ->middleware(['auth', 'verified']);
