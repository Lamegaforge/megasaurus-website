<?php

namespace App\Http\Controllers;

use App\Repositories\PaginateClipsRepository;
use App\Repositories\FindDisplayableClipRepository;
use App\Repositories\Options\PaginationOption;
use Illuminate\Support\Facades\View;
use App\Dtos\Uuid;

class ShowClipController extends Controller
{
    public function __construct(
        private FindDisplayableClipRepository $findDisplayableClipRepository,
        private PaginateClipsRepository $paginateClipsRepository,
    ) {}

    public function __invoke(string $uuid)
    {
        $clip = $this->findDisplayableClipRepository->handle(
            Uuid::fromString($uuid),
        );

        $randomGameClips = $this->paginateClipsRepository->handle(
            PaginationOption::from([
                'game_id' => $clip->game->id,
                'per_page' => 10,
                'random' => true,
            ]),
        );

        return View::make('show-clip', [
            'clip' => $clip,
            'randomGameClips' => $randomGameClips->items(),
        ]);
    }
}
