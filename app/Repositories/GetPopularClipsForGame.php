<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\ValueObjects\Clip;
use Illuminate\Support\Collection;
use App\Enums\ClipStateEnum;

class GetPopularClipsForGame
{
    public function handle(string $uuid): Collection
    {
        $popularClips = DB::table('clips')
            ->select(
                'clips.id',
                'clips.uuid',
                'clips.url',
                'clips.title',
                'clips.views',
                'clips.duration',
                'clips.published_at',
                'games.id as game_id',
                'games.uuid as game_uuid',
                'games.name as game_name',
                'authors.id as author_id',
                'authors.uuid as author_uuid',
                'authors.name as author_name',
            )
            ->join('games', 'clips.game_id', '=', 'games.id')
            ->join('authors', 'clips.author_id', '=', 'authors.id')
            ->where('clips.game_uuid', $uuid)
            ->where('state', ClipStateEnum::Ok)
            ->orderBy('views', 'DESC')
            ->limit(10)
            ->get();

        return $popularClips->map(function ($clip) {
            return Clip::from((array) $clip);
        });
    }
}
