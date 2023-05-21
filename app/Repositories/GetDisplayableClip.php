<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\ValueObjects\ExternalId;
use App\ValueObjects\Clip;

class GetDisplayableClip
{
    public function handle(ExternalId $externalId): Clip
    {
        $clip = DB::table('clips')
            ->select(
                'clips.*',
                'games.name as game_name',
                'games.external_id as game_external_id',
                'authors.name as author_name', 
            )
            ->join('games', 'clips.external_game_id', '=', 'games.external_id')
            ->join('authors', 'clips.author_id', '=', 'authors.id')
            ->where('clips.external_id', $externalId)
            ->where('state', 'ok')
            ->first();

        return Clip::from((array) $clip);
    }
}
