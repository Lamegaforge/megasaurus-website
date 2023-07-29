<?php

namespace App\Services;

use App\Models\Clip;
use App\Storages\AutoplayStorage;

class IframeService
{
    public function __construct(
        private string $baseUrl,
        private array $parents,
        private AutoplayStorage $autoplayStorage,
    ) {}

    public function getSrc(Clip $clip): string
    {
        return $this->baseUrl
            . 'embed?clip=' . $clip->external_id
            . $this->transformParentsList()
            . $this->addAutoplayAttribute();
    }

    private function transformParentsList(): string
    {
        $parents = '';

        foreach ($this->parents as $parent) {
            $parents .= '&parent=' . urlencode($parent);
        }

        return $parents;
    }

    private function addAutoplayAttribute(): string
    {
        $autoplay = $this->autoplayStorage->get();

        $value = $autoplay ? 'true' : 'false';

        return '&autoplay=' . $value;
    }
}
