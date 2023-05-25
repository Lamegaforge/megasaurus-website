<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\ValueObjects\Clip;
use App\Repositories\Options\ClipPaginationOptions;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Domain\Enums\ClipStateEnum;

class PaginateAvailableClips
{
    public function handle(ClipPaginationOptions $options): LengthAwarePaginator
    {
        $query = DB::table('clips')
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
            ->orderByDesc($options->sort);
        
        $query->when($options->search, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%');
        });

        $query->when($options->externalGameId, function ($query, $externalGameId) {
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
