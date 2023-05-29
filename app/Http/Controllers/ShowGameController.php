<?php

namespace App\Http\Controllers;

use App\Repositories\GetPopularClipsForSpecificGame;
use App\ValueObjects\Game;
use App\Repositories\PaginateClips;
use App\Repositories\Options\PaginationOption;

class ShowGameController extends Controller
{
    public function __construct(
        private GetPopularClipsForSpecificGame $getPopularClipsForSpecificGame,
        private PaginateClips $paginateClips,
    ) {}

    public function __invoke(string $externalGameId)
    {
        $popularClips = $this->getPopularClipsForSpecificGame->handle(
            Game::from([
                'external_id' => $externalGameId,
            ]),
        );

        $clips = $this->paginateClips->handle(
            PaginationOption::from([
                'external_game_id' => $externalGameId,
                'sort' => 'clips.published_at',
            ]),
        );

        dd($popularClips, $clips);
    }
}
