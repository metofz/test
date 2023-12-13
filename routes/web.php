<?php

use App\Http\Controllers\Band\AlbumController;
use App\Http\Controllers\Band\BandController;
use App\Http\Controllers\Band\GenreController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LyricController;
use Illuminate\Support\Facades\{Route, Auth};

Auth::routes();

Route::get('/', HomeController::class)->name('home');

Route::middleware('auth')->group(function(){
    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::prefix('bands')->group(function(){
        Route::get('create', [BandController::class, 'create'])->name('bands.create');
        Route::post('create', [BandController::class, 'store']);
        Route::get('table', [BandController::class, 'table'])->name('bands.table');
        Route::get('{band:slug}/edit', [BandController::class, 'edit'])->name('bands.edit');
        Route::put('{band:slug}/edit', [BandController::class, 'update']);
        Route::delete('{band:slug}/delete', [BandController::class, 'destroy'])->name('bands.delete');
    });

    Route::prefix('albums')->group(function(){
        Route::get('create', [AlbumController::class, 'create'])->name('albums.create');
        Route::post('create', [AlbumController::class, 'store']);
        Route::get('table', [AlbumController::class, 'table'])->name('albums.table');
        Route::get('{album:slug}/edit', [AlbumController::class, 'edit'])->name('albums.edit');
        Route::put('{album:slug}/edit', [AlbumController::class, 'update']);
        Route::delete('{album:slug}/delete', [AlbumController::class, 'destroy'])->name('albums.delete');
        Route::get('/get-album-by-{band}', [AlbumController::class, 'getAlbumsByBandId']);
    });

    Route::prefix('genres')->group(function(){
        Route::get('create', [GenreController::class, 'create'])->name('genres.create');
        Route::post('create', [GenreController::class, 'store']);
        Route::get('table', [GenreController::class, 'table'])->name('genres.table');
        Route::get('{genre:slug}/edit', [GenreController::class, 'edit'])->name('genres.edit');
        Route::put('{genre:slug}/edit', [GenreController::class, 'update']);
        Route::delete('{genre:slug}/delete', [GenreController::class, 'destroy'])->name('genres.delete');
    });

    Route::prefix('lyrics')->group(function(){
        Route::get('create', [LyricController::class, 'create'])->name('lyrics.create');
        Route::post('create', [LyricController::class, 'store']);
        Route::get('table', [LyricController::class, 'table'])->name('lyrics.table');
        Route::get('{lyric:slug}/edit', [LyricController::class, 'edit'])->name('lyrics.edit');
        Route::put('{lyric:slug}/edit', [LyricController::class, 'update']);
        Route::delete('{lyric:slug}/delete', [LyricController::class, 'destroy'])->name('lyrics.delete');
    });
});