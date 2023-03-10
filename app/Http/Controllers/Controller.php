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
            'username' => $game->user->username,
            'login' => [
                'image' => $game->login->image,
                'gameCode' => $game->login->gameCode,
                'gameTitle' => $game->login->gameTitle,
                'team' => $game->login->team,
            ],
            'instruction' => collect($game->instruction)->filter(function($instruction) {
                if ($instruction['show'] == false) {
                    return false;
                }
                return true;
            }),
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
                    $returnedOpt['teamAnswer'] = $opt['teamAnswer'];
                    return $returnedOpt;
                });
                $m_item['id'] = $item['id'];
                $m_item['name'] = $item['name'];
                $m_item['component'] = $item['component'];
                $m_item['isSelected'] = $item['isSelected'];
                $m_item['isStarted'] = $item['isStarted'];
                $item = $m_item;
            }
            if ($item['name'] == 'QRCodeFinder') {
                $m_item = [];
                $m_item['data']['id'] = $item['id'];
                $m_item['data']['title'] = $item['data']['title']; 
                $m_item['data']['description'] = $item['data']['description']; 
                // $m_item['data']['result'] = $item['data']['result']; 
                $m_item['name'] = $item['name'];
                $m_item['component'] = $item['component'];
                $m_item['isSelected'] = $item['isSelected'];
                $m_item['isStarted'] = $item['isStarted'];
                $m_item['data']['result'] = isset($item['data']['result']) ? $item['data']['result'] : null;
                $item = $m_item;
            }
            return $item;
        });
        // dd($filterGame);
        return $filterGame;
    }
}
