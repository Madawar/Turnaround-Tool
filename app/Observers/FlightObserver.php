<?php
/**
 * Created by PhpStorm.
 * User: dwanyoike
 * Date: 11-Jun-18
 * Time: 10:15 AM
 */

namespace App\Observers;


use App\Flight;
use Carbon\Carbon;

class FlightObserver
{
    public function retrieved(Flight $flight)
    {


    }

    /**
     * Handle the User "created" event.
     *
     * @param  \App\User $user
     * @return void
     */
    public function created(Flight $flight)
    {
        /*
        if (stripos($flight->flightDate, '/') !== false) {
            $month = Carbon::createFromFormat('Y/m/d H:i', $flight->STA);
        } elseif ($flight->flightDate instanceof Carbon) {
            $month = $flight->flightDate;
        } else {
            $month = Carbon::createFromFormat('Y-m-d H:i', $flight->STA);
        }
        $startOfMonth = $month->copy()->startOfMonth();
        $count = Flight::where('flightDate', '>=', $startOfMonth)->where('flightDate', '<', $month->toDateTimeString())->where('carrier', $flight->carrier)->count();
        $sheetNo = $month->format('Ym') . str_pad($count + 1, 4, "0", STR_PAD_LEFT);
        $flight->serial = $sheetNo;
        $flight->save();
        */

    }



    /**
     * Handle the User "updated" event.
     *
     * @param  \App\User $user
     * @return void
     */
    public function updating(Flight $flight)
    {
        /*
        $month = Carbon::createFromFormat('Y-m-d H:i', $flight->STA);
        $startOfMonth = $month->copy()->startOfMonth();
        $count = Flight::where('flightDate', '>=', $startOfMonth)->where('flightDate', '<', $month->toDateTimeString())->where('carrier', $flight->carrier)->count();
        $sheetNo = $month->format('Ym') . str_pad($count + 1, 4, "0", STR_PAD_LEFT);
        $flight->serial = $sheetNo;
        */
    }

}
