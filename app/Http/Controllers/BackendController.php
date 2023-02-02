<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BackendController extends Controller
{
    public function dashboard() {
        $totalGamehost = User::where('type', 'gamehost')->count();

        if (auth()->user()->type == 'admin') {
            $totalPublishedGame = Game::where('status', 'published')->count();
            $totalUnPublishedGame = Game::where('status', 'draft')->count();
            $totalCompleteGame = Game::where('end_time', '!=', null)->count();
        } else {
            $totalPublishedGame = Game::where('user_id', auth()->id())->where('status', 'published')->count();
            $totalUnPublishedGame = Game::where('user_id', auth()->id())->where('status', 'draft')->count();
            $totalCompleteGame = Game::where('user_id', auth()->id())->where('end_time', '!=', null)->count();
        }
        return Inertia::render('Backend/Dashboard', [
            'totalGamehost' => $totalGamehost,
            'publishedGame' => $totalPublishedGame,
            'unPublishedGame' => $totalUnPublishedGame,
            'completeGame' => $totalCompleteGame,
        ]);
    }
}
