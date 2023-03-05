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
    public function gameHost() {
        if (auth()->user()->type != 'admin') {
            return redirect()->route('dashboard');
        }
        $gamehosts = User::withCount(['game'])->where(['type' => 'gamehost'])->get();
        return Inertia::render('Backend/Gamehost/Index', [
            'gamehosts' => $gamehosts
        ]);
    }
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
                $session = session()->get('login');
                if ($request->writeText==true) {
                    if ($item['id'] == $request->taskId) { 
                        if ($request->startTime) {
                            $item['userAnswer'][] = [
                                'team' => $session['team'],
                                'start_at' => now(),
                                'task_id' => $request->taskId,
                                'ip' => $request->ip()
                            ];
                        }
                        if ($request->answer) {
                            $item['isStarted'] = true;
                            // $temp_item = collect($item['userAnswer'])->filter(function($item) {
                            //     return $item['team']
                            // });
                            $item['userAnswer'] = collect($item['userAnswer'])->map(function($ans) use($session, $request) {
                                if ($session['team'] == $ans['team']) {
                                    $ans['answer'] = $request->answer;
                                    $ans['end_at'] = now();
                                    return $ans;
                                }
                                return $ans;
                            });
                            
                            // $item['userAnswer'][] = $request->answer;
                        }
                        if ($request->value) {
                            $item['userAnswer'] = collect($item['userAnswer'])->map(function($ans) use($request) {
                                if ($request->teamCode == $ans['team']) {
                                    $ans['value'] = $request->value;
                                    return $ans;
                                }
                                return $ans;
                            });
                        }
                    }
                }

                if ($request->Quiz == true) {
                    if ($item['id'] == $request->taskId) {
                        if ($request->startTime) {
                            $item['userAnswer'][] = [
                                'team' => $session['team'],
                                'start_at' => now(),
                                'task_id' => $request->taskId,
                                'ip' => $request->ip()
                            ];
                        }
                        if ($request->answer) {
                            $item['isStarted'] = true;

                            $item['userAnswer'] = collect($item['userAnswer'])->map(function($ans) use($session, $request) {
                                if ($session['team'] == $ans['team']) {
                                    $ans['userOptions'] = $request->answer;
                                    $ans['end_at'] = now();
                                    return $ans;
                                }
                                return $ans;
                            });
                        }
                        if ($request->value) {
                            $item['userAnswer'] = collect($item['userAnswer'])->map(function($ans) use($request) {
                                if ($request->teamCode == $ans['team']) {
                                    $ans['value'] = $request->value;
                                    return $ans;
                                }
                                return $ans;
                            });
                        }
                    }
                }
                if ($request->QRCodeFinder == true) {
                    // dd($request->all());
                    if ($item['id'] == $request->taskId) {
                        if ($request->startTime) {
                            $item['userAnswer'][] = [
                                'team' => $session['team'],
                                'start_at' => now(),
                                'task_id' => $request->taskId,
                                'ip' => $request->ip()
                            ];
                        }
                        if ($request->answer) {
                            $item['isStarted'] = true;
                            $item['userAnswer'] = collect($item['userAnswer'])->map(function($ans) use($session, $request) {
                                if ($session['team'] == $ans['team']) {
                                    $ans['result'] = $request->answer;
                                    $ans['end_at'] = now();
                                    return $ans;
                                }
                                return $ans;
                            });
                        }
                        if ($request->value) {
                            $item['userAnswer'] = collect($item['userAnswer'])->map(function($ans) use($request) {
                                if ($request->teamCode == $ans['team']) {
                                    $ans['value'] = $request->value;
                                    return $ans;
                                }
                                return $ans;
                            });
                        }
                    }
                }

                if ($request->UploadImage == true) {
                    if ($item['id'] == $request->taskId) {
                        if ($request->startTime) {
                            $item['userAnswer'][] = [
                                'team' => $session['team'],
                                'start_at' => now(),
                                'task_id' => $request->taskId,
                                'ip' => $request->ip()
                            ];
                        }
                        if ($request->image) {
                            $item['isStarted'] = true;
                            $item['userAnswer'] = collect($item['userAnswer'])->map(function($ans) use($session, $request) {
                                if ($session['team'] == $ans['team']) {
                                    $ans['image'] = $request->image;
                                    $ans['end_at'] = now();
                                    return $ans;
                                }
                                return $ans;
                            });
                            // $item['userAnswer'][] = [
                            //     'team' => $session['team'],
                            //     'image' => $request->image
                            // ];
                        }
                        if ($request->value) {
                            $item['userAnswer'] = collect($item['userAnswer'])->map(function($ans) use($request) {
                                if ($request->teamCode == $ans['team']) {
                                    $ans['value'] = $request->value;
                                    return $ans;
                                }
                                return $ans;
                            });
                        }
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
            $game->session = session()->get('login');
            $game->ip = request()->ip();
            return response([
                'status' => 'success',
                'game' => $game,
            ]);
        }
        return response([
            'status' => 'error'
        ]);
    }
    
    public function save(Request $request) {
        $data = $request->all(); 

        $game_title = $request->login['gameTitle'];
        $game_code = $request->login['gameCode'];

        $gameExist = Game::where('login->gameCode', $game_code)->orWhere('login->gameTitle', $game_title)->get();

        if($game_code && count($gameExist) > 1) {
            return response([
                'status' => 'failed',
                'message' => 'Game code already exist',
            ], 200);
        }
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
            if (
                count($game->tasks) == 0 ||
                empty($game->login->gameTitle) ||
                empty($game->login->gameCode) ||
                empty($game->login->gamePassword) ||
                count($game->login->team) == 0
            ) {
                return response([
                    'status' => 'failed',
                    'message' => 'Game setup is not complete'
                ]);
            }
            $game->update([
                'status' => 'published',
            ]);
            return response([
                'status' => 'success',
                'message' => 'Game published successfully'
            ]);
        } else {
            $game->update([
                'status' => 'draft',
            ]);
            return response([
                'status' => 'success',
                'message' => 'Game status updated successfully'
            ]);
        }
        return response([
            'status' => 'failed',
            'message' => 'Opps! Something wrong'
        ]);
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
                'user' => $game->user,
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
        $filteredTeam = collect($game->login->team)->filter(function($team) use($request) {            
            return $team->teamCode == $request->team;
        });
        if(!count($filteredTeam)) {
            session()->flash('error', 'Credentials not match');
            return back();
        }
        
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
        $game->session = $session;
        $game->ip = request()->ip();
        $game->username = $game->user->username;
        return Inertia::render('Frontend/StartGame', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'gameData' => $game,
            // 'gameData' => $this->filterGame($game),
        ]);
    }
    public function scoreboard(User $user, $gameCode) {
        $session = session()->get('login');
        if (!$session) return redirect()->route('home');
        if (!isset($session['gamecode']) && $session['gamecode'] != $gameCode) return redirect()->route('home');
        
        $game = Game::where('login->gameCode', $gameCode)->where('user_id', $user->id)->first();
        
        if (!$game) return redirect()->route('home');

        // saveUserData
        // dd($this->filterGame($game));
        return Inertia::render('Frontend/Scoreboard', [
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