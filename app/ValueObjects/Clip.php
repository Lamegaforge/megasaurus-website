<?php

namespace App\ValueObjects;

use Carbon\Carbon;
use stdClass;

readonly final class Clip
{
    public function __construct(
        public string $external_id,
        public string $title,
        public string $name,
    ) {}

    public static function from(stdClass $attributes): self
    {
        return new self(
            external_id: $attributes->external_id,
            title: $attributes->title,
            name: $attributes->name,
        );
    }
}
