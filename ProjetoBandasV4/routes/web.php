<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\BandController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


//Index Controllers:
Route::get('/', [IndexController::class, 'home'])->name('home');
Route::get('/home', [IndexController::class, 'home'])->name('home');
Route::get('/band-view/{id}', [IndexController::class, 'viewBand'])->name('band.view');
Route::get('/album-view/{id}', [IndexController::class, 'viewAlbum'])->name('album.view');
Route::get('/music-view/{id}', [IndexController::class, 'viewMusic'])->name('music.view');
Route::get('/search', [IndexController::class, 'search'])->name('search');

//Band Controllers:
Route::get('/allbands', [BandController::class, 'allBands'])->name('all.bands')->middleware('auth');
Route::post('/create-band', [BandController::class, 'createBand'])->name('band.create')->middleware('auth');
Route::get('/delete-band/{id}', [BandController::class, 'deleteBand'])->name('band.delete')->middleware('auth');
Route::get('/band-detail/{id}', [BandController::class, 'detailBand'])->name('band.detail')->middleware('auth');

//Album Controllers:
Route::post('/create-album', [AlbumController::class, 'createAlbum'])->name('album.create')->middleware('auth');
Route::get('/album-detail/{id}', [AlbumController::class, 'detailAlbum'])->name('album.detail')->middleware('auth');
Route::get('/delete-album/{id}', [AlbumController::class, 'deleteAlbum'])->name('album.delete')->middleware('auth');
Route::get('/add-album', [AlbumController::class, 'showAddAlbumForm'])->name('album.add')->middleware('auth');
Route::post('/album/add', [AlbumController::class, 'storeAlbum'])->name('album.store')->middleware('auth');

//Music Controllers
Route::post('/music/create', [MusicController::class, 'createMusic'])->name('music.create')->middleware('auth');
Route::get('/music/delete/{id}', [MusicController::class, 'deleteMusic'])->name('music.delete')->middleware('auth');
Route::get('/add-music', [MusicController::class, 'showAddMusicForm'])->name('music.add-music')->middleware('auth');
Route::post('/music/add', [MusicController::class, 'storeMusic'])->name('music.store')->middleware('auth');
Route::get('/search/bands', [MusicController::class, 'searchBands'])->name('search.bands')->middleware('auth');
Route::get('/search/albums', [MusicController::class, 'searchAlbums'])->name('search.albums')->middleware('auth');
Route::post('/music/update/{id}', [MusicController::class, 'updateMusic'])->name('music.update')->middleware('auth');

//Fallback
Route::fallback([IndexController::class, 'fallback']);

//User
Route::get('/dashboard',[UserController::class, 'dashboard'] )->name('user.dashboard')->middleware('auth');

