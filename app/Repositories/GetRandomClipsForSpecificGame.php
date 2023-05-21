<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\ValueObjects\Game;
use App\ValueObjects\Clip;
use Illuminate\Support\Collection;

class GetRandomClipsForSpecificGame
{
    public function handle(Game $game): Collection
    {
        $clips = DB::table('clips')
            ->select(
                'clips.external_id',
                'clips.title',
                'clips.url',
                'clips.views',
                'clips.duration',
                'clips.published_at',
                'games.name as game_name',
                'games.external_id as game_external_id',
                'authors.name as author_name',
            )
            ->join('games', 'clips.external_game_id', '=', 'games.external_id')
            ->join('authors', 'clips.author_id', '=', 'authors.id')
            ->where('games.external_id', $game->externalId)
            ->where('state', 'ok')
            ->limit(10)
            ->get();

        return $clips->map(function ($clip) {
            return Clip::from((array) $clip);
        });
    }
}
