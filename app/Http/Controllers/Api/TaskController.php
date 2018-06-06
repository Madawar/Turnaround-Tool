<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Task;
use App\TaskHistory;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function show($id, Request $request)
    {
        $task = Task::find($id);
        $history = TaskHistory::firstOrCreate(array(
            'serviceId' => $task->serviceId,
            'taskId' => $task->id,
            'flightId' => $request->flt
        ));
        if($history->startTime){
            $history->startTime=  Carbon::createFromFormat('H:i:s',$history->startTime )->format('H:i');
        }
        if($history->endTime){
            $history->endTime=  Carbon::createFromFormat('H:i:s',$history->endTime )->format('H:i');
        }
        $history->task_nar = $history->task->task;
        $history->service_nar = $history->service->service;
        return $history;
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
    public function update(Request $request, $id, TaskRequest $form)
    {
        $task = TaskHistory::find($id);
        $task->update($request->all());
        return TaskHistory::find($id);
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
