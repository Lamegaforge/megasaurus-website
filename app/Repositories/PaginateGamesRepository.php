<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Game;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Options\PaginationOption;
use App\Enums\ClipStateEnum;

class PaginateGamesRepository
{
    public function handle(PaginationOption $options): LengthAwarePaginator
    {
        $query = Game::query()
            ->select([
                'games.*',
                DB::raw('COUNT(clips.id) as active_clips_count'),
            ])
            ->leftJoin('clips', function ($join) {
                $join->on('games.id', '=', 'clips.game_id')
                    ->where('clips.state', ClipStateEnum::Ok);
            })
            ->groupBy('games.uuid')
            ->havingRaw('active_clips_count > 0');


        $query->when($options->gameId, function ($query, $gameId) {
            $query->where('game_id', $gameId);
        });

        $query->when($options->sort, function ($query, $sort) {
            $query->orderByDesc($sort);
        });

        $query->when($options->random, function ($query) {
            $query->inRandomOrder();
        });

        return $query->paginate($options->perPage);
    }
}
