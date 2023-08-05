<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Space\ThumbnailService;
use App\Services\Space\CardService;
use App\Services\IframeService;
use App\Storages\AutoplayStorage;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ThumbnailService::class, function ($app) {
            return new ThumbnailService(
                config('app.cdn_url'),
                config('app.cdn_env_folder'),
            );
        });

        $this->app->singleton(CardService::class, function ($app) {
            return new CardService(
                config('app.cdn_url'),
                config('app.cdn_env_folder'),
            );
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
        Carbon::setLocale('fr');
    }
}
