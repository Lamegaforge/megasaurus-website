<?php

namespace App\Dtos;

use Stringable;
use App\Models\Game;
use App\Services\Assert;

readonly final class Uuid implements Stringable
{
    public function __construct(
        public string $value,
    ) {}

    public static function fromString(string $uuid): self
    {
        Assert::nonEmptyString($uuid);

        return new self($uuid);
    }

    public static function fromGame(Game $game): self
    {
        return new self($game->uuid);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
