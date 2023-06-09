<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\ValueObjects\Clip;
use Illuminate\Support\Collection;
use Domain\Enums\ClipStateEnum;

class GetRandomClipsForGame
{
    public function handle(string $id): Collection
    {
        $clips = DB::table('clips')
            ->select(
                'clips.id',
                'clips.title',
                'clips.url',
                'clips.views',
                'clips.duration',
                'clips.published_at',
                'games.name as game_name',
                'games.external_id as game_external_id',
                'authors.name as author_name',
            )
            ->join('games', 'clips.game_id', '=', 'games.id')
            ->join('authors', 'clips.author_id', '=', 'authors.id')
            ->where('games.id', $id)
            ->where('state', ClipStateEnum::Ok)
            ->inRandomOrder()
            ->limit(10)
            ->get();

        return $clips->map(function ($clip) {
            return Clip::from((array) $clip);
        });
    }
}
