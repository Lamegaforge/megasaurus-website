<?php

namespace App\Http\Controllers;

use App\Repositories\FindDisplayableClipRepository;
use App\Actions\GameAndRandomClipsSample;
use Illuminate\Support\Facades\View;
use App\Dtos\Uuid;

class ShowClipController extends Controller
{
    public function __construct(
        private FindDisplayableClipRepository $findDisplayableClipRepository,
        private GameAndRandomClipsSample $getGameAndRandomClipsSample,
    ) {}

    public function __invoke(string $uuid)
    {
        $clip = $this->findDisplayableClipRepository->handle(
            Uuid::fromString($uuid),
        );

        $randomClips = $this->getGameAndRandomClipsSample->handle(
            game: $clip->game,
        );

        return View::make('show-clip', [
            'clip' => $clip,
            'randomClips' => $randomClips,
        ]);
    }
}
