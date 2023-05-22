<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CdnService;

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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
