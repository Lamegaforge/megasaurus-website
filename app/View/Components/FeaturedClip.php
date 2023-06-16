<?php

namespace App\View\Components;

use Closure;
use App\ValueObjects\Clip;
use App\Services\CdnService;
use App\Services\IframeService;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class FeaturedClip extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Clip $featuredClip,
    ) {}

    public function thumbnail(): string
    {
        return app(CdnService::class)->thumbnail($this->featuredClip);
    }

    public function iframeSrc(): string
    {
        return app(IframeService::class)->getSrc($this->featuredClip);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.featured-clip');
    }
}
