<?php

namespace App\Http\Controllers;

use App\Dtos\Hook;
use App\Repositories\PaginateClips;
use App\Repositories\FindDisplayableClip;
use App\Repositories\Options\PaginationOption;

class ShowClipController extends Controller
{
    public function __construct(
        private FindDisplayableClip $findDisplayableClip,
        private PaginateClips $paginateClips,
    ) {}

    public function __invoke(string $hook)
    {
        $clip = $this->findDisplayableClip->handle(
            new Hook($hook),
        );

        $randomGameClips = $this->paginateClips->handle(
            PaginationOption::from([
                'game_uuid' => $clip->game->uuid,
                'per_page' => 10,
                'random' => true,
            ]),
        );

        dd(
            $clip,
            $randomGameClips->items(),
        );
    }
}
