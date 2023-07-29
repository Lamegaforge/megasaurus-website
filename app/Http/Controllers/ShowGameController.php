<?php

namespace App\Http\Controllers;

use App\Dtos\Hook;
use App\Repositories\PaginateClipsRepository;
use Illuminate\Support\Facades\View;
use App\Repositories\FindDisplayableGameRepository;
use App\Repositories\Options\PaginationOption;

class ShowGameController extends Controller
{
    public function __construct(
        private FindDisplayableGameRepository $findDisplayableGameRepository,
        private PaginateClipsRepository $paginateClipsRepository,
    ) {}

    public function __invoke(string $uuid)
    {
        $game = $this->findDisplayableGameRepository->handle(
            Hook::fromString($uuid),
        );

        $popularGameClips = $this->paginateClipsRepository->handle(
            PaginationOption::from([
                'gameId' => $game->uuid,
                'sort' => 'clips.views',
            ]),
        );

        $gameClips = $this->paginateClipsRepository->handle(
            PaginationOption::from([
                'gameId' => $game->uuid,
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
