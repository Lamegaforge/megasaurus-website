<?php

namespace App\Repositories;

use App\Models\Game;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Options\PaginationOption;
use Domain\Enums\ClipStateEnum;

class PaginateGamesRepository
{
    public function handle(PaginationOption $options): LengthAwarePaginator
    {
        $query = Game::query()
            ->whereHas('clips', function ($query) {
                $query->where('state', ClipStateEnum::Ok);
            })
            ->withCount(['clips' => function ($query) {
                $query->where('state', ClipStateEnum::Ok);
            }]);

        $query->when($options->gameUuid, function ($query, $gameUuid) {
            $query->where('game.uuid', $gameUuid);
        });

        $query->when($options->sort, function ($query, $sort) {
            $query->orderByDesc($sort);
        });

        $query->when($options->random, function ($query) {
            $query->inRandomOrder();
        });

        $query->when($options->excludeGames, function ($query, $excludeGames) {
            $query->whereNotIn('uuid', $excludeGames);
        });

        return $query->paginate($options->perPage);
    }
}
