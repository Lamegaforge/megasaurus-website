<?php

namespace App\Repositories;

use App\Models\Game;
use App\Enums\ClipStateEnum;

class PopularGamesRepository
{
    public function handle()
    {
        return Game::query()
            ->withCount(['clips as active_clips_count' => function ($query) {
                $query->where('state', ClipStateEnum::Ok);
            }])
            ->orderBy('active_clips_count', 'DESC')
            ->take(20)
            ->get();
    }
}
