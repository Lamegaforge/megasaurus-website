<?php

namespace App\Http\Controllers;

use App\Repositories\GetPopularClipsForGame;
use App\Repositories\PaginateClips;
use App\Repositories\Options\PaginationOption;

class ShowGameController extends Controller
{
    public function __construct(
        private GetPopularClipsForGame $getPopularClipsForGame,
        private PaginateClips $paginateClips,
    ) {}

    public function __invoke(string $uuid)
    {
        $popularClips = $this->getPopularClipsForGame->handle($uuid);

        $clips = $this->paginateClips->handle(
            PaginationOption::from([
                'game_uuid' => $uuid,
                'sort' => 'clips.published_at',
            ]),
        );

        dd($popularClips, $clips);
    }
}
