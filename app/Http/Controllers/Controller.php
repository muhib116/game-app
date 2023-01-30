<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function filterGame($game) {
        if (!$game) return false;
        $filterGame = [
            'id' => $game->id,
            'login' => [
                'image' => $game->login->image,
                'gameCode' => $game->login->gameCode,
                'gameTitle' => $game->login->gameTitle,
            ],
            'instruction' => $game->instruction,
        ];
        $filterGame['tasks'] = collect($game->tasks)->map(function($item) {
            // if (isset($item['isStarted'])) {
            //     $item['isStarted'] = $item['isStarted'];
            // }
            if ($item['name'] == 'Quiz') {
                $m_item = [];
                $m_item['data']['title'] = $item['data']['title'];
                $m_item['data']['options'] = collect($item['data']['options'])->map(function($opt) {
                    $returnedOpt['name'] = $opt['name'];
                    return $returnedOpt;
                });
                $m_item['name'] = $item['name'];
                $m_item['component'] = $item['component'];
                $m_item['isSelected'] = $item['isSelected'];
                $item = $m_item;
            }
            if ($item['name'] == 'QRCodeFinder') {
                $m_item = [];
                $m_item['data']['title'] = $item['data']['title']; 
                $m_item['data']['description'] = $item['data']['description']; 
                $m_item['name'] = $item['name'];
                $m_item['component'] = $item['component'];
                $m_item['isSelected'] = $item['isSelected'];
                $item = $m_item;
            }
            return $item;
        });
        return $filterGame;
    }
}
