<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\FeaturedClip;
use App\Storages\LatestAvailableClipsStorage;
use App\Storages\LatestGamesStorage;
use App\Storages\PopularGamesStorage;

class HomeController extends Controller
{
    public function __construct(
        private FeaturedClip $featuredClip,
        private LatestAvailableClipsStorage $latestAvailableClipsStorage,
        private LatestGamesStorage $latestGamesStorage,
        private PopularGamesStorage $popularGamesStorage,
    ){}

    public function __invoke(Request $request)
    {
        $featuredClip = $this->featuredClip->handle();

        $latestAvailableClips = $this->latestAvailableClipsStorage->get();

        $latestGames = $this->latestGamesStorage->get();

        $popularGames = $this->popularGamesStorage->get();

        return view('welcome');
    }
}
