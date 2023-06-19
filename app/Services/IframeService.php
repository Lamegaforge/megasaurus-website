<?php

namespace App\Services;

use App\ValueObjects\Clip;

class IframeService
{
    public function __construct(
        private string $baseUrl,
        private array $parents,
    ) {}

    public function getSrc(Clip $clip): string
    {
        return $this->baseUrl
            . 'embed?clip=' . $clip->externalId
            . $this->transformParentsList();
    }

    private function transformParentsList(): string
    {
        $parents = '';

        foreach ($this->parents as $parent) {
            $parents .= '&parent=' . urlencode($parent);
        }

        return $parents;
    }
}
