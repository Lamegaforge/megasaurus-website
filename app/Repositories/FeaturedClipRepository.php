<?php

namespace App\Repositories;

use App\Models\Clip;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FeaturedClipRepository
{
    public const MinimumViewsToBeFeatured = 40;

    public function handle(): Clip
    {
        $clips = Clip::with('game', 'author')
            ->displayable()
            ->where('views', '>=', self::MinimumViewsToBeFeatured)
            ->latest('published_at')
            ->limit(50)
            ->get();

        if ($clips->isEmpty()) {
            throw new NotFoundHttpException();
        }

        $clips->random();

        return $clips->first();
    }
}
