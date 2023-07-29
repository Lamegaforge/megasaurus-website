<?php

namespace App\Services\Space;

use App\Models\Clip;

class ThumbnailService
{
    public function __construct(
        private string $baseCdn,
        private string $envFolder,
    ) {}

    public function get(Clip $clip): string
    {
        return $this->baseCdn . '/' . $this->envFolder . '/thumbnails/' . $clip->uuid;
    }
}
