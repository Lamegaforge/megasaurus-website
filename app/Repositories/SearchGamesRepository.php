<?php

namespace App\Repositories;

use App\Models\Game;
use Domain\Enums\ClipStateEnum;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchGamesRepository
{
    public function handle(string $search): LengthAwarePaginator
    {
        $games = Game::search($search)
            ->query(function ($builder) {

                $resolveCurrentPage = LengthAwarePaginator::resolveCurrentPage();

                if ($resolveCurrentPage === 1) {
                    $skip = 0;
                }
                else {
                    $skip = $resolveCurrentPage * 12;
                }

                $builder->whereHas('clips', function ($query) {
                    $query->where('state', ClipStateEnum::Ok);
                })
                ->skip($skip)
                ->limit(12);
            })
            ->get();

        return new LengthAwarePaginator(
            items: $games,
            total: count($games),
            perPage: 12, 
        );
    }
}
