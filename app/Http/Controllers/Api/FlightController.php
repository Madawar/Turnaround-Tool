<?php

namespace App\Http\Controllers\Api;

use App\Flight;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flights = Flight::with('cx')->get();
        $flights->map(function ($item) {
            $varDate = Carbon::createFromFormat('Y-m-d', $item->flightDate);
            $item->flightDate = $varDate->format('jS-M-y');
            $item->flt = $item->cx->carrier . '-' . $item->flightNo;
            if ($varDate->isToday()) {
                $item->narration = 'Today';
            } elseif ($varDate->isTomorrow()) {
                $item->narration = 'Tomorrow';
            } elseif ($varDate->isYesterday()) {
                $item->narration = 'Yesterday';
            }
            return $item;
        });
        return $flights;
    }

    public function page()
    {
        $flight = Flight::with('cx')->paginate();
        $flight->map(function ($item) {
            $item['view'] = action('FlightController@show', $item->id);
            $item['edit'] = action('FlightController@edit', $item->id);
            $item['delete'] = action('FlightController@destroy', $item->id);
            return $item;
        });
        return $flight;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
