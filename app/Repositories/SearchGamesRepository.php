<?php

namespace App\Repositories;

use App\Models\Game;
use Domain\Enums\ClipStateEnum;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SearchGamesRepository
{
    public function handle(string $search): LengthAwarePaginator
    {
        $games = Game::search($search)
            ->query(function ($builder) {
                $builder->whereHas('clips', function ($query) {
                    $query->where('state', ClipStateEnum::Ok);
                });
            })
            ->paginate(12);

        return $games;
    }
}
