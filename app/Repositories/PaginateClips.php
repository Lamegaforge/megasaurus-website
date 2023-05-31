<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\ValueObjects\Clip;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
<<<<<<< Updated upstream:app/Repositories/PaginateClips.php
use App\Repositories\Options\PaginationOption;
=======
use Domain\Enums\ClipStateEnum;
>>>>>>> Stashed changes:app/Repositories/PaginateAvailableClips.php

class PaginateClips
{
    public function handle(PaginationOption $options): LengthAwarePaginator
    {
        $query = DB::table('clips')
            ->select(
                'clips.id',
                'clips.external_id',
                'clips.url',
                'clips.title',
                'clips.views',
                'clips.duration',
                'clips.published_at',
                'games.name as game_name',
                'games.id as game_id',
                'games.external_id as game_external',
                'authors.id as author_id',
                'authors.name as author_name',
            )
            ->join('games', 'clips.game_id', '=', 'games.id')
            ->join('authors', 'clips.author_id', '=', 'authors.id')
<<<<<<< Updated upstream:app/Repositories/PaginateClips.php
            ->where('state', $options->clipStateEnum);

        $query->when($options->sort, function ($query, $sort) {
            $query->orderByDesc($sort);
        });

        $query->when($options->search, function ($query, $search) {
=======
            ->where('state', ClipStateEnum::Ok)
            ->orderByDesc($paginateClips->sort);
        
        $query->when($paginateClips->search, function ($query, $search) {
>>>>>>> Stashed changes:app/Repositories/PaginateAvailableClips.php
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
