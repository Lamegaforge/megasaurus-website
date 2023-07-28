<?php

namespace App\Repositories;

use App\Models\Clip;
use Illuminate\Support\Collection;

class GetRandomClipsForGame
{
    public function handle(int $id): Collection
    {
        return Clip::with('game', 'author')
            ->displayable()
            ->where('game_id', $id)
            ->inRandomOrder()
            ->limit(10)
            ->get();
    }
}
