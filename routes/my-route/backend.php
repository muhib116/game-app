<?php

use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/dashboard', function () {
    return Inertia::render('Backend/Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/game', function () {
    return Inertia::render('Backend/Game/index');
})->middleware(['auth', 'verified'])->name('game');

Route::get('/game/setup/{id}', function ($id) {
    return Inertia::render('Backend/Game/Create', [
        'id' => $id
    ]);
})->middleware(['auth', 'verified'])->name('game.setup');



Route::post('/game/save/{game?}', [GameController::class, 'save'])->name('game.save');
Route::post('/game/list', [GameController::class, 'list'])->name('game.list');