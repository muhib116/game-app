<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function save(Request $request, Game $game) {
        $data = $request->all();
        if ($game) {
            $game->update($data);
        } else {
            Game::create($data);
        }
    }
}
