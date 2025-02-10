<?php

namespace App\Providers;

use App\Repositories\Contracts\SportApiRepositoryInterface;
use App\Repositories\SportApiRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SportApiRepositoryInterface::class, SportApiRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
