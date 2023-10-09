<?php

namespace App\Repositories;

use App\Models\Clip;
use App\Repositories\Options\PaginationOption;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class PaginateClipsRepository
{
    public function handle(PaginationOption $options): LengthAwarePaginator | Paginator
    {
        $query = Clip::query()
            ->with('author')
            ->withWhereHas('game', function ($query) use ($options) {
                $query->when($options->gameUuid, function ($query, $gameUuid) {
                    $query->where('games.uuid', $gameUuid);
                });
            })->displayable();

        $query->when($options->sort, function ($query, $sort) {
            $query->orderByDesc($sort);
        });

        $query->when($options->random, function ($query) {
            $query->inRandomOrder();
        });

        $pagination = $options->getPaginationMethod();

        return $query->{$pagination}($options->perPage, ['*'], $options->pageName);
    }
}
