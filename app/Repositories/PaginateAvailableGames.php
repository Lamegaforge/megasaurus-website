<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\ValueObjects\Game;
use App\Repositories\Options\GamePaginationOptions;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PaginateAvailableGames
{
    public function handle(GamePaginationOptions $options): LengthAwarePaginator
    {
        $query = DB::table('games')
            ->select(
                'games.*',
                DB::raw('COUNT(clips.id) as active_clips_count'),
            )
            ->leftJoin('clips', function ($join) {
                $join->on('games.external_id', '=', 'clips.external_game_id')
                    ->where('clips.state', 'ok');
            })
            ->groupBy('games.external_id')
            ->havingRaw('active_clips_count > 0')
            ->orderByDesc($options->sort);

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
