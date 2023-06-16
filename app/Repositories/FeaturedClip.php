<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\ValueObjects\Clip;
use Domain\Enums\ClipStateEnum;

class FeaturedClip
{
    public function handle()
    {
        $featuredClips = DB::table('clips')
            ->select(
                'clips.id',
                'clips.uuid',
                'clips.external_id',
                'clips.url',
                'clips.title',
                'clips.views',
                'clips.duration',
                'clips.published_at',
                'games.name as game_name',
                'games.id as game_id',
                'games.uuid as game_uuid',
                'authors.id as author_id',
                'authors.uuid as author_uuid',
                'authors.name as author_name',
            )
            ->join('games', 'clips.game_id', '=', 'games.id')
            ->join('authors', 'clips.author_id', '=', 'authors.id')
            ->where('state', ClipStateEnum::Ok)
            ->where('views', '>=', 10)
            ->latest('published_at')
            ->limit(30)
            ->get();

        return Clip::from(
            (array) $featuredClips->random(),
        );
    }
}
