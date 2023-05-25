<?php

use App\Http\Controllers\BackendController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/dashboard', [BackendController::class, 'dashboard'])->name('dashboard');
    Route::get('/game', function () {
        return Inertia::render('Backend/Game/index');
    })->name('game');
    Route::get('/gamehosts', [GameController::class, 'gameHost'])->name('gamehosts');
    Route::get('/create-gamehosts', [GameController::class, 'createGameHost'])->name('createGameHost');
    Route::post('/store-gamehosts', [GameController::class, 'storeGameHost'])->name('storeGameHost');
    Route::get('/game/setup/{id}', [GameController::class, 'setup'])->name('game.setup');
    Route::get('/game/dashboard/{id}', [GameController::class, 'gameDashboard'])->name('game.dashboard');
    
    Route::post('/game/save/{game?}', [GameController::class, 'save'])->name('game.save');
    Route::post('/game/list', [GameController::class, 'list'])->name('game.list');
    Route::post('/media/upload', [MediaController::class, 'upload'])->name('media.upload');
    Route::post('/media/delete', [MediaController::class, 'delete'])->name('media.delete');
    Route::get('/files', [MediaController::class, 'index'])->name('files');
    Route::post('/game/delete/{game}', [GameController::class, 'delete'])->name('game.delete');
    Route::post('/game/publish/{game}', [GameController::class, 'publish'])->name('game.publish');
});


Route::post('/game/save_user_data', [GameController::class, 'save_user_data'])->name('game.save_user_data');
Route::post('/image/upload', [ImageController::class, 'upload'])->name('image.upload');
Route::post('/image/delete', [ImageController::class, 'delete'])->name('image.delete');





