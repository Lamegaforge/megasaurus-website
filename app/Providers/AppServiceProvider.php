<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CdnService;
use App\Services\IframeService;
use App\Storages\AutoplayStorage;

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
                $app[AutoplayStorage::class],
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
