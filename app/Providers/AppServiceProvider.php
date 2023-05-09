<?php

namespace App\Providers;

use App\Interfaces\ForecastInterface;
use App\Interfaces\SearchInterface;
use App\Services\Foursquare\SearchService as FoursquareSearchService;
use App\Services\OpenWeatherMap\ForecastService as OpenWeatherMapForecastService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ForecastInterface::class, OpenWeatherMapForecastService::class);
        $this->app->bind(SearchInterface::class, FoursquareSearchService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
