<?php

namespace App\Http\Controllers;

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
        $services = Service::with('tasks')->get();
        $flightId = $id;
        $services->map(function ($item) use ($flightId) {
            foreach ($item->tasks as $task) {
                $stat = TaskHistory::where('serviceId', $task->serviceId)->where('taskId', $task->id)->where('flightId', $flightId)->first();

                if (count($stat)) {
                    $task->startTime = $stat->startTime;
                    $task->endTime = $stat->endTime;
                    if ($stat->startTime != "" and $stat->endTime == "") {
                        $task->status = 'Ongoing';
                    }

                    if ($stat->startTime != "" and $stat->endTime != "") {

                        $startTime = Carbon::createFromFormat('H:i:s', $stat->startTime);
                        $endTime = Carbon::createFromFormat('H:i:s', $stat->endTime);
                        if ($endTime->lessThan($startTime)) {
                            $endTime = $endTime->addDay();
                        }
                        $timing = $endTime->diffInMinutes($startTime);
                        $hours = $endTime->diffInHours($startTime);
                        $task->minutes = $timing;
                        $task->remarks = $stat->remarks;
                        $task->status = 'Completed in ' . $timing . " Minutes";
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
        return view('flights.view_flight')->with(compact('services'));
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
