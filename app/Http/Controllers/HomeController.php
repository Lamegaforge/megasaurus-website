<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\LatestAvailableClips;
use App\Repositories\FeaturedClip;
use App\Repositories\LatestCards;
use Illuminate\Support\Facades\Cache;
use App\Services\TtlFactory;

class HomeController extends Controller
{
    public function __construct(
        private LatestAvailableClips $latestAvailableClips,
        private FeaturedClip $featuredClip,
        private LatestCards $LatestCards,
    ){}

    public function __invoke(Request $request)
    {
        $featuredClip = $this->featuredClip->handle();

        $latestAvailableClips = Cache::remember('latest_available_clips', TtlFactory::minutes(1), function () {
            return $this->latestAvailableClips->handle();
        });

        $latestCards = Cache::remember('latest_cards', TtlFactory::minutes(1), function () {
            return $this->LatestCards->handle();
        });

        dd($latestAvailableClips, $featuredClip, $latestCards);
    }
}
