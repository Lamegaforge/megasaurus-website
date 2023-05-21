<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class FeaturedClip
{
    public function handle()
    {
        $featuredClips = DB::table('clips')
            ->select('clips.external_id', 'title', 'name')
            ->join('games', 'clips.external_game_id', '=', 'games.external_id')
            ->where('state', 'ok')
            ->where('views', '>=', 10)
            ->latest('published_at')
            ->limit(30)
            ->get();
        
        return $featuredClips->random();
    }
}
