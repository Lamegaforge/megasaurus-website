<?php

namespace App\Http\Controllers;

use App\Repositories\FeaturedClipRepository;
use App\Storages\LatestAvailableClipsStorage;
use App\Storages\LatestGamesStorage;
use App\Storages\PopularGamesStorage;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function __construct(
        private FeaturedClipRepository $featuredClipRepository,
        private LatestAvailableClipsStorage $latestAvailableClipsStorage,
        private LatestGamesStorage $latestGamesStorage,
        private PopularGamesStorage $popularGamesStorage,
    ){}

    public function __invoke()
    {
        $featuredClip = $this->featuredClipRepository->handle();

        $latestAvailableClips = $this->latestAvailableClipsStorage->get();

        $latestGames = $this->latestGamesStorage->get();

        $popularGames = $this->popularGamesStorage->get();

        return View::make('welcome', [
            'featuredClip' => $featuredClip,
            'latestAvailableClips' => $latestAvailableClips,
            'latestGames' => $latestGames,
            'popularGames' => $popularGames,
        ]);
    }
}
