<?php

namespace App\Repositories;

use App\Models\Game;
use Domain\Enums\ClipStateEnum;

class PopularGamesRepository
{
    public function handle()
    {
        return Game::query()
            ->orderByDesc('active_clip_count')
            ->where('uuid', '!=', config('app.game_nowhere_uuid'))
            ->take(12)
            ->get();
    }
}
