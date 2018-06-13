<?php

namespace App\Http\Controllers\Api;

use App\Carrier;
use App\Flight;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flights = Flight::with('services.tasks.records')->with('tasks')->get();
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

    public function flightList()
    {
        return Carrier::select(DB::raw('carrier as name'), 'id')->get();
    }

    public function page()
    {
        $flight = Flight::with('cx', 'tasks.task')->orderBy('flightDate')->paginate();
        $flight->map(function ($item) {
            $item->button = 'View Report';
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

            if ($item->completed == 0) {
                $item->status = '<span class="status-icon bg-danger"></span> Incomplete';
            } else {
                $item->status = '<span class="status-icon bg-success"></span> Completed';
            }

            $item->tasks->map(function ($task) {
                $task->taskName = $task->task->task;
                if ($task->startTime != "" and $task->endTime == "") {
                    $task->status = 'Ongoing';
                }
                if ($task->startTime != "" and $task->endTime != "") {
                    $startTime = Carbon::createFromFormat('H:i:s', $task->startTime);
                    $endTime = Carbon::createFromFormat('H:i:s', $task->endTime);
                    if ($endTime->lessThan($startTime)) {
                        $endTime = $endTime->addDay();
                    }
                    $timing = $endTime->diffInMinutes($startTime);
                    $hours = $endTime->diffInHours($startTime);
                    $milli = $endTime->diffInSeconds($startTime) * 1000;
                    $task->minutes = $timing;
                    $task->milli = $milli;
                    $task->remarks = $task->remarks;
                    $task->status = 'Completed in ' . $timing . " Minutes";
                    $task->modEndTime = $endTime->format('D M d Y H:i:s O');
                    $task->modStartTime = $startTime->format('D M d Y H:i:s O');
                }

                if ($task->startTime == "" and $task->endTime == "") {
                    $task->status = 'Not Started';
                }
            });

            $item['view'] = action('FlightController@show', $item->id);
            $item['edit'] = action('FlightController@edit', $item->id);
            $item['delete'] = action('FlightController@destroy', $item->id);
            return $item;
        });
        return $flight;
    }

    public function report($id)
    {
        $flight = Flight::with('services.tasks.records')->with('tasks')->find($id);
        if ($flight->arrival) {
            $time = $flight->arrival;
            $flight->arr = Carbon::createFromFormat('Y-m-d H:i', $flight->arrival)->format('D M d Y H:i:s O');
            $flight->startTime = Carbon::createFromFormat('Y-m-d H:i', $time)->addMinute(5)->format('D M d Y H:i:s O');
        } else {
            $time = $flight->STD;
            $flight->arr = Carbon::createFromFormat('Y-m-d H:i', $flight->STD)->format('D M d Y H:i:s O');
            $flight->startTime = Carbon::createFromFormat('Y-m-d H:i', $time)->addMinute(5)->format('D M d Y H:i:s O');
        }
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
                        $flightDate = $flight->flightDate;
                        $startTime = Carbon::createFromFormat('Y-m-d H:i:s', $flightDate.' '. $record->startTime);
                        $endTime = Carbon::createFromFormat('Y-m-d H:i:s', $flightDate.' '.$record->endTime);
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
        $name = Helper::createReport($flight);
        return array('file' =>Storage::url($name));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public
    function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public
    function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
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
    public
    function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        //
    }
}
