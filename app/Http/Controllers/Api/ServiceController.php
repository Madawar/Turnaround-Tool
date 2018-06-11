<?php

namespace App\Http\Controllers\Api;

use App\Flight;
use App\Http\Controllers\Controller;
use App\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $flight = Flight::with('services.tasks.records')->with('tasks')->find($request->flightId);
        $flight->services->map(function ($service, $key) use ($flight) {
            $service->tasks->map(function ($task, $key) use ($flight) {
                $flight->rows = 0;
                $record = $flight->tasks->where('taskId', $task->id)->first();
                if ($record) {
                    $task->startTime = $record->startTime;
                    $task->endTime = $record->endTime;
                    if ($record->startTime != "" and $record->endTime == "") {
                        $task->status = 'Ongoing';
                    }
                    if ($record->startTime != "" and $record->endTime != "") {
                        $startTime = Carbon::createFromFormat('H:i:s', $record->startTime);
                        $endTime = Carbon::createFromFormat('H:i:s', $record->endTime);
                        if ($endTime->lessThan($startTime)) {
                            $endTime = $endTime->addDay();
                        }
                        $timing = $endTime->diffInMinutes($startTime);
                        $hours = $endTime->diffInHours($startTime);
                        $milli = $endTime->diffInSeconds($startTime) * 1000;
                        $task->minutes = $timing;
                        $task->milli = $milli;
                        $task->remarks = $record->remarks;
                        $task->status = 'Completed in ' . $timing . " Minutes";
                        $task->modEndTime = $endTime->format('D M d Y H:i:s O');
                        $task->modStartTime = $startTime->format('D M d Y H:i:s O');
                    }
                    if ($record->startTime == "" and $record->endTime == "") {
                        $task->status = 'Not Started';
                    }

                } else {
                    $task->status = 'Not Started';
                }
                return $task;
            });
            return $service;

        });
        return $flight->services;
    }

    public function page(Request $request)
    {
        $service = Service::with('tasks')->where('carrierId', $request->carrier)->paginate();
        $service->map(function ($item) {
            $item['view'] = action('ServiceController@show', $item->id);
            $item['edit'] = action('ServiceController@edit', array('id'=>$item->id,'carrierId'=>$item->carrierId));
            $item['delete'] = action('ServiceController@destroy', $item->id);
            $item['button'] = "View Tasks";
            return $item;
        });
        return $service;
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
