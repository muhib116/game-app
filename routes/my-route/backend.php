<?php
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/dashboard', function () {
    return Inertia::render('Backend/Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/game', function () {
    return Inertia::render('Backend/Game/index');
})->middleware(['auth', 'verified'])->name('game');

Route::get('/game/create', function () {
    return Inertia::render('Backend/Game/Create');
})->middleware(['auth', 'verified'])->name('game.create');