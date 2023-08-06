<?php

namespace App\Repositories;

use App\Models\Game;
use Domain\Enums\ClipStateEnum;

class PopularGamesRepository
{
    public function handle()
    {
        return Game::query()
            ->withCount(['clips' => function ($query) {
                $query->where('state', ClipStateEnum::Ok);
            }])
            ->where('uuid', '!=', config('app.game_nowhere_uuid'))
            ->orderBy('clips_count', 'DESC')
            ->take(12)
            ->get();
    }
}
