<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\ValueObjects\Game;
use Domain\Enums\ClipStateEnum;

class PopularGames
{
    public function handle()
    {
        $popularGames = DB::table('games')
            ->select('games.name', 'games.external_id', DB::raw('COUNT(clips.id) as active_clips_count'))
            ->leftJoin('clips', function ($join) {
                $join->on('games.external_id', '=', 'clips.external_game_id')
                    ->where('clips.state', ClipStateEnum::Ok);
            })
            ->groupBy('games.id')
            ->orderBy('active_clips_count', 'DESC')
            ->limit(10)
            ->get();

        return $popularGames->map(function ($game) {
            return Game::from((array) $game);
        });
    }
}
