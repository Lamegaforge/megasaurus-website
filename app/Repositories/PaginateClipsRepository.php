<?php

namespace App\Repositories;

use App\Models\Clip;
use App\Repositories\Options\PaginationOption;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PaginateClipsRepository
{
    public function handle(PaginationOption $options): LengthAwarePaginator
    {
        $query = Clip::query()
            ->with('game', 'author')
            ->displayable();

        $query->when($options->gameId, function ($query, $gameId) {
            $query->where('game_id', $gameId);
        });

        $query->when($options->sort, function ($query, $sort) {
            $query->orderByDesc($sort);
        });

        $query->when($options->random, function ($query) {
            $query->inRandomOrder();
        });

        $clips = $query->paginate($options->perPage);

        return $clips;
    }
}
