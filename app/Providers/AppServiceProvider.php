<?php

namespace App\Providers;

use App\Services\BookingService;
use App\Services\BookingServiceInterface;
use Illuminate\Support\ServiceProvider;
use App\Services\EventServiceInterface;
use App\Services\EventService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EventServiceInterface::class, EventService::class);
        $this->app->bind(BookingServiceInterface::class, BookingService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
