<?php

namespace App\ValueObjects;

use Stringable;
use Illuminate\Http\Request;

readonly final class ExternalId implements Stringable
{
    public function __construct(
        public string $value,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            value: $request->external_id,
        );
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
