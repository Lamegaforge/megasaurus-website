<?php

namespace App\Storages;

use App\Enums\AutoplayEnum;
use Illuminate\Session\SessionManager;

class AutoplayStorage
{
    public function __construct(
        private SessionManager $session,
    ) {}

    public function set(bool $value): void
    {
        $this->session->put(AutoplayEnum::Storage->value, $value);
    }

    public function get(): bool
    {
        return (bool) $this->session->get(AutoplayEnum::Storage->value);
    }
}
