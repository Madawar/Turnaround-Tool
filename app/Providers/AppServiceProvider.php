<?php

namespace App\Providers;

use App\Carrier;
use App\Flight;
use App\Observers\CarrierObserver;
use App\Observers\ServiceObserver;
use App\Observers\FlightObserver;
use App\Service;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carrier::observe(CarrierObserver::class);
        Service::observe(ServiceObserver::class);
        Flight::observe(FlightObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
