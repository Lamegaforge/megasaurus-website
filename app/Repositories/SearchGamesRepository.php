<?php

namespace App\Repositories;

use App\Models\Game;
use Domain\Enums\ClipStateEnum;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchGamesRepository
{
    public function handle(string $search)
    {
        return Game::search($search)
            ->query(function ($builder) {
                $builder->whereHas('clips', function ($query) {
                    $query->where('state', ClipStateEnum::Ok);
                })
                ->limit(24);
            })
            ->get();
    }
}
