<?php

namespace App\Repositories;

use App\Models\Clip;

class FeaturedClipRepository
{
    public const MinimumViewsToBeFeatured = 20;

    public function handle(): Clip
    {
        $clip = Clip::with('game', 'author')
            ->displayable()
            ->where('views', '>=', self::MinimumViewsToBeFeatured)
            ->latest('published_at')
            ->limit(50)
            ->inRandomOrder()
            ->firstOrFail();

        return $clip;
    }
}
