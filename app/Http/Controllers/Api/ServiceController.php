<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service;
use App\TaskHistory;
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
        $tasks = Service::with('tasks')->get();
        $flightId = $request->flightId;
        $tasks->map(function ($item)use($flightId) {
            foreach ($item->tasks as $task) {
                $stat = TaskHistory::where('serviceId', $task->serviceId)->where('taskId', $task->id)->where('flightId', $flightId)->first();

                if (count($stat)) {
                    if ($stat->startTime != "" and $stat->endTime == "") {
                        $task->status = 'Ongoing';
                    }

                    if ($stat->startTime != "" and $stat->endTime != "") {
                        $task->status = 'Complete';
                    }

                    if ($stat->startTime == "" and $stat->endTime == "") {
                        $task->status = 'Not Started';
                    }
                }else{
                    $task->status = 'Not Started';
                }
            }

            return $item;
        });
        return $tasks;
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
