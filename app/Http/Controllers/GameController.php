<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class GameController extends Controller
{
    public function setup($id) {
        $game = Game::find($id);
        if (!$game) {
            return redirect()->route('dashboard');
        }
        return Inertia::render('Backend/Game/Create', [
            'id' => $id
        ]);
    }

    public function save(Request $request) {
        $data = $request->all(); 
        if ($request->id) {
            $game = Game::find($request->id)->update([
                'user_id' => auth()->id(),
                'login' => $request->login,
                'instruction' => $request->instruction,
                'status' => $request->status,
                'tasks' => $request->tasks,
            ]);
        } else {
            $game = Game::create([
                'user_id' => auth()->id(),
                'login' => $request->login,
                'instruction' => $request->instruction,
                'status' => $request->status,
                'tasks' => $request->tasks,
            ]);
        }
        
        return $game;
    }

    public function list(Request $request) {
        $query = Game::query()->with(['user']);
        if ($request->id) {
            $query->where('id', $request->id);
        }
        if ($request->getFirst) {
            return $query->first();
        }
        return $query->get();
    }

    public function delete(Game $game) {
        $game->delete();
        return back();
    }


    public function gameLogin(User $user, $gamename) {
        $game = Game::where('login->gameCode', $gamename)->first();
        if (!$game) {
            return redirect('/');
        }
        // dd($game);
        return Inertia::render('Frontend/Login/index', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'game' => [
                'id' => $game->id,
                'gameTitle' => $game->login->gameTitle,
                'image' => $game->login->image,
            ],
        ]);
    }

    public function authorizeGame(Request $request) {
        $request->validate([
            'gameCode' => 'required',
            'password' => 'required'
        ]);
        $game = Game::where('login->gameCode', $request->gameCode)->first();
        $gameCode = $request->gameCode;
        $password = $request->password;
        if ($game) {
            if ($gameCode == $game->login->gameCode && $password == $game->login->gamePassword) {
                session()->put('login', [
                    'gamecode' => $gameCode,
                    'password' => $password,
                ]);
                return redirect(url('instruction/'.$game->user->username.'/'.$game->login->gameCode));
            } else {
                session()->flash('error', 'Game code or password not metch');
                return back();
            }
        } else {
            session()->flash('error', 'Game code or password not metch');
            return back();
        }
        // $game
    }

    public function startGame(User $user, $gameCode) {
        $session = session()->get('login');
        if (!$session) return redirect()->route('home');
        if (!isset($session['gamecode']) && $session['gamecode'] != $gameCode) return redirect()->route('home');

        $game = Game::where('login->gameCode', $gameCode)->where('user_id', $user->id)->first();
        if (!$game) return redirect()->route('home');

        return Inertia::render('Frontend/StartGame', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'gameData' => $this->filterGame($game),
        ]);
    }

    public function instruction(User $user, $gameCode) {
        $session = session()->get('login');
        if (!isset($session['gamecode']) && $session['gamecode'] != $gameCode) return redirect()->route('home');

        $game = Game::where('login->gameCode', $gameCode)->where('user_id', $user->id)->first();
        if (!$game) return redirect()->route('home');
        // dd($game);
        return Inertia::render('Frontend/Instruction', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'gameData' => $this->filterGame($game),
        ]);
    }
}
