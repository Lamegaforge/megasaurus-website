<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\ValueObjects\Game;
use Domain\Enums\ClipStateEnum;

class LatestGames
{
    public function handle()
    {
        $latestGames = DB::table('games')
            ->select(
                'games.id',
                'games.uuid',
                'games.external_id',
                'games.name', 
            )
            ->leftJoin('clips', function ($join) {
                $join->on('games.id', '=', 'clips.game_id')
                    ->where('clips.state', ClipStateEnum::Ok);
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
