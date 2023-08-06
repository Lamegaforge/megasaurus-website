<?php

namespace App\Repositories;

use App\Dtos\Uuid;
use App\Models\Game;
use Domain\Enums\ClipStateEnum;

class FindDisplayableGameRepository
{
    public function handle(Uuid $uuid): Game
    {
        return Game::query()
            ->whereHas('clips', function ($query) {
                $query->where('state', ClipStateEnum::Ok);
            })
            ->withCount(['clips' => function ($query) {
                $query->where('state', ClipStateEnum::Ok);
            }])
            ->where('games.uuid', $uuid)
            ->firstOrFail();
    }
}
