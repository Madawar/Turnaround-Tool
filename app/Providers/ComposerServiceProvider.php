<?php

namespace App\Providers;

use App\Carrier;
use App\Flight;
use App\Observers\CarrierObserver;
use App\Observers\ServiceObserver;
use App\Observers\FlightObserver;
use App\Service;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            'view_flight', 'App\Http\ViewComposers\ReportComposer'
        );
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
