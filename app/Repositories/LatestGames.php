<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\ValueObjects\Game;

class LatestGames
{
    public function handle()
    {
        $latestGames = DB::table('games')
            ->select('games.name', 'games.external_id')
            ->leftJoin('clips', function ($join) {
                $join->on('games.external_id', '=', 'clips.external_game_id')
                    ->where('clips.state', 'ok');
            })
            ->groupBy('games.id')
            ->orderBy('games.created_at', 'DESC')
            ->limit(10)
            ->get();

        return $latestGames->map(function ($game) {
            return Game::from((array) $game);
        });
    }
}
