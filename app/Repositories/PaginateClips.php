<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\ValueObjects\Clip;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Options\PaginationOption;

class PaginateClips
{
    public function handle(PaginationOption $options): LengthAwarePaginator
    {
        $query = DB::table('clips')
            ->select(
                'clips.id',
                'clips.uuid',
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
            ->join('authors', 'clips.author_id', '=', 'authors.id');

        $query->when($options->gameUuid, function ($query, $gameUuid) {
            $query->where('games.uuid', $gameUuid);
        });

        $query->when($options->sort, function ($query, $sort) {
            $query->orderByDesc($sort);
        });

        $query->when($options->search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        });

        $query->when($options->random, function ($query) {
            $query->inRandomOrder();
        });

        $clips = $query->paginate($options->perPage);

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
