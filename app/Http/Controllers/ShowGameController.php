<?php

namespace App\Http\Controllers;

use App\Dtos\Uuid;
use App\Repositories\PaginateClipsRepository;
use Illuminate\Support\Facades\View;
use App\Repositories\FindDisplayableGameRepository;
use App\Repositories\Options\PaginationOption;
use Illuminate\Pagination\LengthAwarePaginator;

class ShowGameController extends Controller
{
    public function __construct(
        private FindDisplayableGameRepository $findDisplayableGameRepository,
        private PaginateClipsRepository $paginateClipsRepository,
    ) {}

    public function __invoke(string $uuid)
    {
        $game = $this->findDisplayableGameRepository->handle(
            Uuid::fromString($uuid),
        );

        $popularGameClips = $this->paginateClipsRepository->handle(
            PaginationOption::from([
                'game_uuid' => $game->uuid,
                'sort' => 'clips.views',
            ]),
        );

        $gameThumbnail = $this->getRandomThumbnailFromClips($popularGameClips);

        $gameClips = $this->paginateClipsRepository->handle(
            PaginationOption::from([
                'game_uuid' => $game->uuid,
                'sort' => 'clips.published_at',
            ]),
        );

        return View::make('show-game', [
            'game' => $game,
            'popularGameClips' => $popularGameClips->items(),
            'gameClips' => $gameClips,
            'gameThumbnail' => $gameThumbnail,
        ]);
    }

    private function getRandomThumbnailFromClips(LengthAwarePaginator $popularGameClips): string
    {
        $clips = $popularGameClips->items();

        shuffle($clips);

        return $clips[0]->thumbnail();
    }
}
