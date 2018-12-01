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
        $month = Carbon::createFromFormat('Y/m/d', $flight->flightDate);
        $count = Flight::where('flightDate', '>=', $month->startOfMonth())->where('flightDate','<=',$month)->where('id','<',$flight->id)->where('carrier', $flight->carrier)->count();
        $sheetNo = $month->format('Ym') . str_pad($count + 1, 4, "0", STR_PAD_LEFT);
        $flight->serial = $sheetNo;
        $flight->save();
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\User $user
     * @return void
     */
    public function updated(Flight $flight)
    {
        if ($flight->serial == "") {
            $month = Carbon::createFromFormat('Y-m-d', $flight->flightDate);
            $count = Flight::where('flightDate', '>=', $month->startOfMonth())->where('flightDate','<=',$month)->where('id','<',$flight->id)->where('carrier', $flight->carrier)->count();
            $sheetNo = $month->format('Ym') . str_pad($count + 1, 4, "0", STR_PAD_LEFT);
            $flight->serial = $sheetNo;
            $flight->save();
        }

    }

}