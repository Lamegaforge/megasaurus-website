<?php

namespace App\Repositories;

use App\Models\Clip;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Domain\Enums\ClipStateEnum;

class SearchClipsRepository
{
    public function handle(string $search): LengthAwarePaginator
    {
        $clips = Clip::search($search)
            ->where('state', ClipStateEnum::Ok->value)
            ->query(function ($builder) {
                $builder->with('game');
            })
            ->paginate(16);

        return $clips;
    }
}
