<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameValidatorController extends Controller
{
    public function loginScreenValidation(Request $request) {
        $gameExist = Game::where('login->gameCode', $request->gameCode)
                            ->orWhere('login->gameTitle', $request->gameTitle)
                            ->get()
                            ->where('user_id', auth()->id())
                            ->where('id', '!=', $request->id)
                            ->count();
        return $gameExist;
    }
}
