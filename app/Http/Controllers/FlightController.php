<?php

namespace App\Http\Controllers;

use App\Flight;
use App\Service;
use App\TaskHistory;
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
        return view('flights.view_flights');
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
        $flight = Flight::find($id);
        $time = $flight->arrival;
        $flight->arrival = Carbon::createFromFormat('Y-m-d H:i:s', $flight->arrival)->format('D M d Y H:i:s O');
        $flight->startTime = Carbon::createFromFormat('Y-m-d H:i:s', $time)->addMinute(5)->format('D M d Y H:i:s O');

        $services = Service::with('tasks')->get();
        $flightId = $id;
        $services->map(function ($item) use ($flightId) {
            $item->rows = 0;
            foreach ($item->tasks as $task) {
                $stat = TaskHistory::where('serviceId', $task->serviceId)->where('taskId', $task->id)->where('flightId', $flightId)->first();

                if (count($stat)) {

                    $task->startTime = $stat->startTime;
                    $task->endTime = $stat->endTime;
                    if ($stat->startTime != "" and $stat->endTime == "") {
                        $task->status = 'Ongoing';
                    }

                    if ($stat->startTime != "" and $stat->endTime != "") {
                        $item->rows = $item->rows + 1;
                        $startTime = Carbon::createFromFormat('H:i:s', $stat->startTime);
                        $endTime = Carbon::createFromFormat('H:i:s', $stat->endTime);
                        if ($endTime->lessThan($startTime)) {
                            $endTime = $endTime->addDay();
                        }
                        $timing = $endTime->diffInMinutes($startTime);
                        $hours = $endTime->diffInHours($startTime);
                        $milli = $endTime->diffInSeconds($startTime) * 1000;
                        $task->minutes = $timing;
                        $task->milli = $milli;
                        $task->remarks = $stat->remarks;
                        $task->status = 'Completed in ' . $timing . " Minutes";
                        $task->modEndTime = $endTime->format('D M d Y H:i:s O');
                        $task->modStartTime = $startTime->format('D M d Y H:i:s O');
                    }

                    if ($stat->startTime == "" and $stat->endTime == "") {
                        $task->status = 'Not Started';
                    }
                } else {
                    $task->status = 'Not Started';
                }
            }

            return $item;
        });
        return view('flights.view_flight')->with(compact('services', 'flight'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $flight = Flight::find($id);
        return view('flights.create_flight')->with(compact('flight'));
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
