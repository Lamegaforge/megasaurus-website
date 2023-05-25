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
            ->where('state', ClipStateEnum::Ok)
            ->latest('published_at')
            ->limit(30)
            ->get();
        
        return $latestAvailableClips->map(function ($clip) {
            return Clip::from((array) $clip);
        });
    }
}
