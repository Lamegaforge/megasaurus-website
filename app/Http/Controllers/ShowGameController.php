<?php

namespace App\Http\Controllers;

use App\Dtos\Hook;
use App\Repositories\PaginateClips;
use Illuminate\Support\Facades\View;
use App\Repositories\FindDisplayableGame;
use App\Repositories\Options\PaginationOption;

class ShowGameController extends Controller
{
    public function __construct(
        private FindDisplayableGame $findDisplayableGame,
        private PaginateClips $paginateClips,
    ) {}

    public function __invoke(string $uuid)
    {
        $game = $this->findDisplayableGame->handle(
            Hook::fromString($uuid),
        );

        $popularGameClips = $this->paginateClips->handle(
            PaginationOption::from([
                'game_uuid' => $game->uuid,
                'sort' => 'clips.views',
            ]),
        );

        $gameClips = $this->paginateClips->handle(
            PaginationOption::from([
                'game_uuid' => $game->uuid,
                'sort' => 'clips.published_at',
            ]),
        );

        return View::make('show-game', [
            'game' => $game,
            'popularGameClips' => $popularGameClips->items(),
            'gameClips' => $gameClips,
        ]);
    }
}
