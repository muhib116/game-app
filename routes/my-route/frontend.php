<?php

use App\Http\Controllers\GameController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Frontend/Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::get('instruction', function () {
    return Inertia::render('Frontend/Instruction', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('instruction');

Route::get('start-game/{user:username}/{gamecode}', [GameController::class, 'startGame'])->name('start.game');
Route::get('instruction/{user:username}/{gamecode}', [GameController::class, 'instruction'])->name('game.instruction');

Route::get('/{username}/{gamecode}/task', function () {
    return Inertia::render('Frontend/Task', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('task');


Route::get('{user:username}/{gamecode}', [GameController::class, 'gameLogin']);
Route::post('/authorizeGame', [GameController::class, 'authorizeGame'])->name('authorizeGame');

Route::post('exit-game', [GameController::class, 'game_exit'])->name('game_exit');

// Route::get('user/login', function () {
//     return Inertia::render('Frontend/Login/index', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });