<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use App\ValueObjects\Clip;
use App\ValueObjects\PaginateClips;

class PaginateAvailableClips
{
    public function handle(PaginateClips $paginateClips): LengthAwarePaginator
    {
        $query = DB::table('clips')
            ->select(
                'clips.*',
                'games.name as game_name',
                'games.external_id as game_external_id',
                'authors.name as author_name', 
            )
            ->join('games', 'clips.external_game_id', '=', 'games.external_id')
            ->join('authors', 'clips.author_id', '=', 'authors.id')
            ->where('state', 'ok')
            ->orderByDesc($paginateClips->sort);
        
        $query->when($paginateClips->search, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%');
        });

        $query->when($paginateClips->externalGameId, function ($query, $externalGameId) {
            $query->where('external_game_id', $externalGameId);
        });

        $clips = $query->paginate(20);

        $clips = $this->transform($clips);

        return $clips;
    }

    private function transform(LengthAwarePaginator $clips): LengthAwarePaginator
    {
        $clips->through(function ($clip) {
            return Clip::from((array) $clip);
        });

        return $clips;
    }
}
