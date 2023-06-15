<?php

namespace App\Http\Controllers;

use App\Repositories\FindDisplayableClip;
use App\Repositories\PaginateClips;
use App\Repositories\Options\PaginationOption;

class ShowClipController extends Controller
{
    public function __construct(
        private FindDisplayableClip $findDisplayableClip,
        private PaginateClips $paginateClips,
    ) {}

    public function __invoke(string $uuid)
    {
        $clip = $this->findDisplayableClip->handle($uuid);

        $randomGameClips = $this->paginateClips->handle(
            PaginationOption::from([
                'gameUuid' => $clip->game->uuid,
                'random' => true,
            ]),
        );

        dd($randomGameClips->items());
    }
}
