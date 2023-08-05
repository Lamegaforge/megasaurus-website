<?php

namespace App\Repositories;

use App\Dtos\Uuid;
use Illuminate\Support\Facades\DB;
use App\Models\Game;
use Domain\Enums\ClipStateEnum;

class FindDisplayableGameRepository
{
    public function handle(Uuid $uuid): Game
    {
        return Game::query()
            ->select('games.*', DB::raw('COUNT(clips.id) as active_clips_count'))
            ->leftJoin('clips', 'games.id', '=', 'clips.game_id')
            ->where('games.uuid', $uuid)
            ->where('clips.state', ClipStateEnum::Ok)
            ->groupBy('games.id')
            ->havingRaw('COUNT(clips.id) > 0')
            ->firstOrFail();
    }
}
