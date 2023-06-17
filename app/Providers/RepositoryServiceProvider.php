<?php

namespace App\Providers;

use App\Interfaces\{BookableSlotInterface, BookingInterface};
use App\Repositories\{BookableSlotRepository, BookingRepository};
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BookableSlotInterface::class, BookableSlotRepository::class);
        $this->app->bind(BookingInterface::class, BookingRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
