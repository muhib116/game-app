<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/dashboard', function () {
    return Inertia::render('Backend/Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/game', function () {
    return Inertia::render('Backend/Game/index');
})->middleware(['auth', 'verified'])->name('game');

Route::get('/game/setup/{id}', [GameController::class, 'setup'])->middleware(['auth', 'verified'])->name('game.setup');


Route::post('/game/save/{game?}', [GameController::class, 'save'])->name('game.save');
Route::post('/game/list', [GameController::class, 'list'])->name('game.list');
Route::post('/game/delete/{game}', [GameController::class, 'delete'])->name('game.delete');

Route::post('/image/upload', [ImageController::class, 'upload'])->name('image.upload');
Route::post('/image/delete', [ImageController::class, 'delete'])->name('image.delete');