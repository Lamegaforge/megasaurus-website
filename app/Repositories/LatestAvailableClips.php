<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\ValueObjects\Clip;
use Domain\Enums\ClipStateEnum;

class LatestAvailableClips
{
    public function handle()
    {
        $latestAvailableClips = DB::table('clips')
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
                'games.external_id as game_external',
                'authors.id as author_id',
                'authors.uuid as author_uuid',
                'authors.name as author_name',
            )
            ->join('games', 'clips.id', '=', 'games.id')
            ->join('authors', 'clips.author_id', '=', 'authors.id')
            ->where('state', ClipStateEnum::Ok)
            ->latest('published_at')
            ->limit(30)
            ->get();
        
        return $latestAvailableClips->map(function ($clip) {
            return Clip::from((array) $clip);
        });
    }
}
