<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use App\ValueObjects\Clip;

class PaginateAvailableClips
{
    public function handle(): LengthAwarePaginator
    {
        $clips = DB::table('clips')
            ->select(
                'clips.*',
                'games.name as game_name',
                'games.external_id as game_external_id',
                'authors.name as author_name', 
            )
            ->join('games', 'clips.external_game_id', '=', 'games.external_id')
            ->join('authors', 'clips.author_id', '=', 'authors.id')
            ->where('state', 'ok')
            ->paginate(20);

        $clips->through(function ($clip) {
            return Clip::from((array) $clip);
        });

        return $clips;
    }
}
