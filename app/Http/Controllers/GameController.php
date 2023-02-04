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

    public function gameDashboard($id) {
        $game = Game::find($id);
        if (!$game) {
            return redirect()->route('dashboard');
        }
        return Inertia::render('Backend/Game/Dashboard', [
            'id' => $id,
            'game' => $game,
        ]);
    }

    public function save_user_data(Request $request) {
        $game = Game::find($request->id);
        if ($game) {
            // return $request->all();
            $isFinished = [];
            $newTask = collect($game->tasks)->map(function($item) use($request, $isFinished) {
                if ($request->writeText==true) {
                    if ($item['id'] == $request->taskId) {
                        $item['isStarted'] = true;
                        $item['answer'] = $request->answer;
                    }
                }

                if ($request->Quiz == true) {
                    if ($item['id'] == $request->taskId) {
                        $item['isStarted'] = true;
                        $item['userOptions'] = $request->answer;
                    }
                }

                if ($request->QRCodeFinder == true) {
                    if ($item['id'] == $request->taskId) {
                        $item['isStarted'] = true;
                        $item['data']['result'] = $request->answer;
                    }
                }

                if ($request->UploadImage == true) {
                    if ($item['id'] == $request->taskId) {
                        $item['isStarted'] = true;
                        $item['data']['image'] = $request->image;
                    }
                }
                array_push($isFinished, 'false');
                return $item;
            });
            // return $newTask;
            $isFinished = collect($newTask)->filter(function($item) {
                return !$item['isStarted'];
            });
            if (count($isFinished) == 0) {
                $game->end_time = now();
            }
            $game->tasks = $newTask;
            $game->save();
            return response([
                'status' => 'success'
            ]);
        }
        return response([
            'status' => 'error'
        ]);
    }

    public function save(Request $request) {
        $data = $request->all(); 
        if ($request->id) {
            $game = Game::find($request->id)->update([
                'user_id' => auth()->id(),
                'slug' => str()->slug(auth()->user()->name),
                'login' => $request->login,
                'instruction' => $request->instruction,
                'status' => $request->status,
                'tasks' => $request->tasks,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ]);
        } else {
            $game = Game::create([
                'user_id' => auth()->id(),
                'slug' => str()->slug(auth()->user()->name),
                'login' => $request->login,
                'instruction' => $request->instruction,
                'status' => $request->status,
                'tasks' => $request->tasks,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ]);
        }
        
        return $game;
    }

    public function list(Request $request) {
        $query = Game::query()->with(['user']);
        if (auth()->user()->type != 'admin') {
            $query->where('user_id', auth()->id());
        }
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
    public function publish(Game $game) {
        if ($game->status == 'draft') {
            $game->update([
                'status' => 'published',
            ]);
        } else {
            $game->update([
                'status' => 'draft',
            ]);
        }
        return back();
    }


    public function gameLogin(User $user, $gamename) {
        $session = session()->get('login');
        $game = Game::where('login->gameTitle', $gamename)->first();
        
        if (!$game) {
            return redirect('/');
        }
        if ($game->status == 'draft') {
            return redirect('/');
        }

        if ($session) {
            // $session
            return redirect(url('instruction/'.$game->user->username.'/'.$game->login->gameTitle));
            // $game
            // ${game.user.username}/${game.login.gameTitle}`
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
            'gameData' => $this->filterGame($game),
        ]);
    }

    public function authorizeGame(Request $request) {
        $request->validate([
            'gameCode' => 'required',
            'team' => 'required',
            'password' => 'required'
        ]);
        $game = Game::where('login->gameCode', $request->gameCode)->first();
        $gameCode = $request->gameCode;
        $password = $request->password;
        $team = $request->team;
        if ($game) {
            if ($gameCode == $game->login->gameCode && $password == $game->login->gamePassword) {
                session()->put('login', [
                    'gamecode' => $gameCode,
                    'password' => $password,
                    'team' => $team,
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

        if (!$game->start_time) {
            $game->update([
                'start_time' => now(),
            ]);
        }
        // saveUserData
        // dd($this->filterGame($game));
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
        if (!$session) return redirect()->route('home');
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

    public function game_exit() {
        session()->put('login', null);
        return back();
    }
}
