<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Enums\ClipStateEnum;

class LatestGamesRepository
{
    public function handle()
    {
        $latestGames = DB::table('games')
            ->select(
                'games.id',
                'games.uuid',
                'games.name', 
            )
            ->join('clips', function ($join) {
                $join->on('games.id', '=', 'clips.game_id')
                    ->where('clips.state', ClipStateEnum::Ok);
            })
            ->groupBy('games.id')
            ->orderBy('games.created_at', 'DESC')
            ->limit(20)
            ->get();

        return $latestGames;
    }
}
