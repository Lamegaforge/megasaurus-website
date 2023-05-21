<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\ValueObjects\Clip;

class LatestAvailableClips
{
    public function handle()
    {
        $latestAvailableClips = DB::table('clips')
            ->select('clips.external_id', 'title', 'name')
            ->join('games', 'clips.external_game_id', '=', 'games.external_id')
            ->where('state', 'ok')
            ->latest('published_at')
            ->limit(30)
            ->get();
        
        return $latestAvailableClips->map(function ($clip) {
            return Clip::from((array) $clip);
        });
    }
}
