<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\GetDisplayableClip;
use App\Repositories\GetRandomClipsForSpecificGame;
use App\ValueObjects\ExternalId;

class ShowClipController extends Controller
{
    public function __construct(
        private GetDisplayableClip $getDisplayableClip,
        private GetRandomClipsForSpecificGame $getRandomClipsForSpecificGame,
    ) {}

    public function __invoke(Request $request)
    {
        $clip = $this->getDisplayableClip->handle(
            externalId: ExternalId::fromRequest($request),
        );

        $randomGameClips = $this->getRandomClipsForSpecificGame->handle(
            game: $clip->game,
        );

        dd(
            $clip, 
            $randomGameClips,
        );
    }
}
