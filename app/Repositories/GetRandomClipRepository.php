<?php

namespace App\Repositories;

use App\Models\Clip;

class GetRandomClipRepository
{
    public function handle(): Clip
    {
        return Clip::query()
            ->displayable()
            ->inRandomOrder()
            ->first();
    }
}
