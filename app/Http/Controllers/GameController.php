<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class GameController extends Controller
{
    protected function permissionCheck(Game $game) {
        if(auth()->user()->type == 'admin') return true;
        if($game->user_id == auth()->id()) return true;
        return false;
    }
    public function gameHost() {
        if (auth()->user()->type != 'admin') {
            return redirect()->route('dashboard');
        }
        $gamehosts = User::withCount(['game'])->where(['type' => 'gamehost'])->get();
        return Inertia::render('Backend/Gamehost/Index', [
            'gamehosts' => $gamehosts
        ]);
    }
    public function editGameHost($id) {
        $gamehost = User::find($id);
        if (auth()->user()->type != 'admin') {
            return redirect()->route('dashboard');
        }
        
        return Inertia::render('Backend/Gamehost/Create', [
            'gamehost' => $gamehost
        ]);
    }
    public function createGameHost() {
        if (auth()->user()->type != 'admin') {
            return redirect()->route('dashboard');
        }
        return Inertia::render('Backend/Gamehost/Create');
    }
    public function storeGameHost(Request $request) {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:'.User::class,
            'email' => 'required|unique:'.User::class,
            'password' => 'required',
        ]);
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'status' => $request->status ? 1 : 0,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('gamehosts')->with('success', 'Gamehost created successfully');
    }
    public function updateGameHost(Request $request, User $user) {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$user->id,
            'email' => 'required|unique:users,email,'.$user->id,
        ]);
        
        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'status' => $request->status ? 1 : 0,
        ];
        if($request->password) {
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);
        return redirect()->route('gamehosts')->with('success', 'Gamehost updated successfully');
    }
    public function deleteGameHost(User $user) {
        DB::beginTransaction();
        try {
            Game::where('user_id', $user->id)->delete();
            $user->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('gamehosts')->with('success', 'Opps! Something wrong.');
        }
        return redirect()->route('gamehosts')->with('success', 'Gamehost deleted successfully');
    }
    public function setup($id) {
        $game = Game::find($id);
        if (!$game || !$this->permissionCheck($game)) {
            return redirect()->route('dashboard');
        }
        return Inertia::render('Backend/Game/Create', [
            'id' => $id
        ]);
    }

    public function gameDashboard($id) {
        $game = Game::find($id);
        if (!$game || !$this->permissionCheck($game)) {
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
                            $item['userAnswer'] = collect($item['userAnswer'])->map(function($ans) use($session, $request) {
                                if ($session['team'] == $ans['team']) {
                                    $ans['answer'] = $request->answer;
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

            $notFinished = collect($newTask)->filter(function($item) use($game) {
                return count($game->login->team) != count($item['userAnswer']);
            });
            
            if (count($notFinished) == 0) {
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
        $game_password = $request->login['gamePassword'];

        if(!$request->newGame == 'new') {
            if (empty($game_title)) {
                return response([
                    'status' => 'failed',
                    'message' => 'Game title is required.',
                ], 200);
            }
            if (empty($game_code)) {
                return response([
                    'status' => 'failed',
                    'message' => 'Game code is required',
                ], 200);
            }
            if (empty($game_password)) {
                return response([
                    'status' => 'failed',
                    'message' => 'Game password is required',
                ], 200);
            }
        }

        $gameExist = Game::where('login->gameCode', $game_code)->orWhere('login->gameTitle', $game_title)->get();

        if($game_code && count($gameExist) > 1) {
            return response([
                'status' => 'failed',
                'message' => 'Game title or code already exist',
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
        if(!$this->permissionCheck($game)) {
            return back();
        }
        $game->delete();
        return back();
    }
    public function publish(Game $game) {
        if (!$this->permissionCheck($game)) {
            return response([
                'status' => 'failed',
                'message' => 'Permission denied'
            ]);
        }
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
        if ($session && $session['gamecode'] == $game->login->gameCode) {
            return redirect(url('instruction/'.$game->user->username.'/'.$game->login->gameCode));
        }

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
        if (!$game) {
            session()->flash('error', 'Credentials not match');
            return back();
        }
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

        $game->username = $game->user->username;
        return Inertia::render('Frontend/Scoreboard', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'gameData' => $game,
        ]);
    }

    public function getScoreboard(User $user, $gameCode) {
        $session = session()->get('login');
        if (!$session) return redirect()->route('home');
        if (!isset($session['gamecode']) && $session['gamecode'] != $gameCode) return redirect()->route('home');
        
        $game = Game::where('login->gameCode', $gameCode)->where('user_id', $user->id)->first();
        
        if (!$game) return redirect()->route('home');

        $game->username = $game->user->username;
        return [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'gameData' => $game,
        ];
    }

    public function photostream(User $user, $gameCode) {
        $session = session()->get('login');
        if (!$session) return redirect()->route('home');
        if (!isset($session['gamecode']) && $session['gamecode'] != $gameCode) return redirect()->route('home');
        
        $game = Game::where('login->gameCode', $gameCode)->where('user_id', $user->id)->first();
        
        if (!$game) return redirect()->route('home');

        $game->username = $game->user->username;
        return Inertia::render('Frontend/Photostream', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'gameData' => $game,
        ]);
    }
    public function totalScoreboard(User $user, $gameCode) {
        $session = session()->get('login');
        if (!$session) return redirect()->route('home');
        if (!isset($session['gamecode']) && $session['gamecode'] != $gameCode) return redirect()->route('home');
        
        $game = Game::where('login->gameCode', $gameCode)->where('user_id', $user->id)->first();
        
        if (!$game) return redirect()->route('home');
        $game->username = $game->user->username;
        return Inertia::render('Frontend/TotalScoreboard', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'gameData' => $game,
        ]);
    }

    public function instruction(User $user, $gameCode) {
        $session = session()->get('login');
        if (!$session) return redirect()->route('home');
        if (!isset($session['gamecode']) && $session['gamecode'] != $gameCode) return redirect()->route('home');

        $game = Game::where('login->gameCode', $gameCode)->where('user_id', $user->id)->first();
        if (!$game) return redirect()->route('home');
        // dd($game);
        $game->username = $game->user->username;
        return Inertia::render('Frontend/Instruction', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'gameData' => $game,
        ]);
    }

    public function game_exit() {
        session()->put('login', null);
        return back();
    }
}