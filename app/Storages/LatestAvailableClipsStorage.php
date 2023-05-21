<?php

namespace App\Storages;

use App\Repositories\LatestAvailableClips;
use App\Services\TtlFactory;
use Illuminate\Cache\CacheManager;
use Illuminate\Support\Collection;

class LatestAvailableClipsStorage
{
    public function __construct(
        private LatestAvailableClips $latestAvailableClips,
        private CacheManager $cache,
    ) {}

    public function get(): Collection
    {
        return $this->cache->remember('latest_available_clips', TtlFactory::minutes(1), function () {
            return $this->latestAvailableClips->handle();
        });
    }
}
