<?php

namespace App\Repositories;

use App\Models\Clip;

class FindDisplayableClipRepository
{
    public function handle(string $uuid): Clip
    {
        return Clip::where('uuid', $uuid)
            ->with('game', 'author')
            ->displayable()
            ->firstOrFail();
    }
}
