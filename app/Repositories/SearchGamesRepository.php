<?php

namespace App\Repositories;

use App\Models\Game;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SearchGamesRepository
{
    public function handle(string $search): LengthAwarePaginator
    {
        $games = Game::search($search)
            ->paginate(16);

        return $games;
    }
}
