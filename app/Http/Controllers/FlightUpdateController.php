<?php

namespace App\Http\Controllers;

use App\Flight;
use App\TaskHistory;
use Helper;
use Illuminate\Http\Request;
use Auth;

class FlightUpdateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $flight = Flight::with('services.tasks.records')->with('tasks')->find($id);
        $flight->services->map(function ($item) use ($id) {
            $item->tasks->map(function ($item) use ($id) {

                $history = TaskHistory::where('taskId', $item->id)->where('serviceId', $item->serviceId)->where('flightId', $id)->first();
                if(count((array)$history) > 0){
                $item->startTime = $history->startTime;
                $item->staffNumber = $history->staffNumber;
                $item->endTime = $history->endTime;
                $item->remarks = $history->remarts;
                }else{
                    $item->startTime = '';
                    $item->endTime = '';
                    $item->remarks = '';
                    $item->staffNumber = "";
                }
                return $item;
            });
            return $item;
        });
        return view('flights.flight_data')->with(compact('flight'));
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
        $data = $request->data;

        foreach ($data as $time) {

            $task = TaskHistory::firstOrCreate(
                ['flightId' => $time['flightId'], 'serviceId' => $time['serviceId'], 'taskId' => $time['taskId']]

            );
            $task->update(array(
                'startTime' => Helper::formatTime($time['startTime']),
                'endTime' => Helper::formatTime($time['endTime']),
                'remarks' => $time['remarks'],
                'staffNumber'=>$time['staffNumber']

            ));
        }
        return redirect()->action('FlightController@show', array('id'=>$id));
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
