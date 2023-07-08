<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use App\Storages\AutoplayStorage;
use Illuminate\Contracts\View\View;

class Footer extends Component
{
    public function autoplay(): bool
    {
        return app(AutoplayStorage::class)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.footer');
    }
}
