<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
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
}
