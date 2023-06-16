<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CdnService;
use App\Services\IframeService;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CdnService::class, function ($app) {
            return new CdnService(config('app.cdn_url'));
        });

        $this->app->singleton(IframeService::class, function ($app) {
            return new IframeService(
                config('iframe.base_url'),
                config('iframe.parents'),
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
