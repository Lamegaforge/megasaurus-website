<?php

namespace App\Http\Controllers;

use App\Repositories\FindDisplayableClip;
use App\Repositories\GetRandomClipsForGame;

class ShowClipController extends Controller
{
    public function __construct(
        private FindDisplayableClip $findDisplayableClip,
        private GetRandomClipsForGame $getRandomClipsForGame,
    ) {}

    public function __invoke(string $id)
    {
        $clip = $this->findDisplayableClip->handle($id);

        $randomGameClips = $this->getRandomClipsForGame->handle($clip->game->id);

        dd($randomGameClips);
    }
}
