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
            ->select(
                'games.id',
                'games.uuid',
                'games.name', 
                DB::raw('COUNT(clips.id) as active_clips_count'),
            )
            ->leftJoin('clips', function ($join) {
                $join->on('games.id', '=', 'clips.game_id')
                    ->where('clips.state', ClipStateEnum::Ok);
            })
            ->groupBy('games.id')
            ->orderBy('active_clips_count', 'DESC')
            ->limit(20)
            ->get();

        return $popularGames->map(function ($game) {
            return Game::from((array) $game);
        });
    }
}
