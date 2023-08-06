<?php

namespace App\Repositories;

use App\Models\Clip;
use App\Dtos\Uuid;

class FindDisplayableClipRepository
{
    public function handle(Uuid $uuid): Clip
    {
        return Clip::where('uuid', $uuid)
            ->with('game', 'author')
            ->displayable()
            ->firstOrFail();
    }
}
