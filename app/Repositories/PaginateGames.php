<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\ValueObjects\Game;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Options\PaginationOption;

class PaginateGames
{
    public function handle(PaginationOption $options): LengthAwarePaginator
    {
        $query = DB::table('games')
            ->select(
                'games.*',
                DB::raw('COUNT(clips.id) as active_clips_count'),
            )
            ->leftJoin('clips', function ($join) use($options) {
                $join->on('games.external_id', '=', 'clips.external_game_id')
                    ->where('clips.state', $options->clipStateEnum);
            })
            ->groupBy('games.external_id')
            ->havingRaw('active_clips_count > 0');

        $query->when($options->sort, function ($query, $sort) {
            $query->orderByDesc($sort);
        });

        $query->when($options->search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        });

        $games = $query->paginate(20);

        $games = $this->transform($games);

        return $games;
    }

    private function transform(LengthAwarePaginator $games): LengthAwarePaginator
    {
        $games->through(function ($game) {
            return Game::from((array) $game);
        });

        return $games;
    }
}
