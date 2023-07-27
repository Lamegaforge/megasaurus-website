<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\ValueObjects\Clip;
use Illuminate\Support\Collection;
use App\Enums\ClipStateEnum;

class GetRandomClipsForGame
{
    public function handle(string $uuid): Collection
    {
        $clips = DB::table('clips')
            ->select(
                'clips.id',
                'clips.uuid',
                'clips.title',
                'clips.url',
                'clips.views',
                'clips.duration',
                'clips.published_at',
                'games.name as game_name',
                'games.uuid as game_uuid',
                'authors.name as author_name',
                'authors.uuid as author_uuid',
            )
            ->join('games', 'clips.game_id', '=', 'games.id')
            ->join('authors', 'clips.author_id', '=', 'authors.id')
            ->where('games.uuid', $uuid)
            ->where('state', ClipStateEnum::Ok)
            ->inRandomOrder()
            ->limit(10)
            ->get();

        return $clips->map(function ($clip) {
            return Clip::from((array) $clip);
        });
    }
}
