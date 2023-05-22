<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\FindDisplayableClip;
use App\Repositories\GetRandomClipsForSpecificGame;
use App\ValueObjects\ExternalId;
use App\Services\CdnService;

class ShowClipController extends Controller
{
    public function __construct(
        private FindDisplayableClip $findDisplayableClip,
        private GetRandomClipsForSpecificGame $getRandomClipsForSpecificGame,
    ) {}

    public function __invoke(Request $request)
    {
        $clip = $this->findDisplayableClip->handle(
            externalId: ExternalId::fromRequest($request),
        );

        $randomGameClips = $this->getRandomClipsForSpecificGame->handle(
            game: $clip->game,
        );

        dd(
            $clip, 
            app(CdnService::class)->card($clip->game),
            app(CdnService::class)->thumbnail($clip),
            $randomGameClips,
        );
    }
}
