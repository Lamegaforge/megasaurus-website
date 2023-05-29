<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\ValueObjects\Game;
use App\ValueObjects\Clip;
use Illuminate\Support\Collection;
use Domain\Enums\ClipStateEnum;

class GetPopularClipsForSpecificGame
{
    public function handle(Game $game): Collection
    {
        $popularClips = DB::table('clips')
            ->where('clips.external_game_id', $game->externalId)
            ->where('state', ClipStateEnum::Ok)
            ->orderBy('views', 'DESC')
            ->limit(10)
            ->get();

        return $popularClips->map(function ($clip) {
            return Clip::from((array) $clip);
        });
    }
}
