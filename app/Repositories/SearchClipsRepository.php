<?php

namespace App\Repositories;

use App\Models\Clip;
use App\Enums\ClipStateEnum;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchClipsRepository
{
    public function handle(string $search): LengthAwarePaginator
    {
        $clips = Clip::search($search)
            ->query(function ($builder) {
                $builder
                    ->displayable()
                    ->with('game');
            })
            ->paginate(16);

        return $clips;
    }
}
