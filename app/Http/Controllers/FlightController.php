<?php

namespace App\Http\Controllers;

use App\Carrier;
use App\Flight;
use App\Http\Requests\FlightFormRequest;
use App\IncidentalService;
use App\IncidentalServiceList;
use App\TaskHistory;
use Carbon\Carbon;
use DB;
use Excel;
use Helper;
use Illuminate\Http\Request;

class FlightController extends Controller
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
        return view('flights.view_flights');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $incids = json_encode(array());
        $incidentalServices = IncidentalServiceList::select(DB::raw('INCid as id'), DB::raw('description as name'))->get();
        $incidentalServices = json_encode($incidentalServices);
        return view('flights.create_flight')->with(compact('incids', 'incidentalServices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, FlightFormRequest $form)
    {
        $flight = Flight::create($request->except('incidservices', 'incidentalservice'));
        $items = json_decode($request->incidservices);
        if ($items != null) {
            foreach (json_decode($request->incidservices) as $service) {
                $service = (array)$service;
                $service['flightId'] = $flight->id;
                IncidentalService::firstOrCreate(array(
                    'flightId' => $service['flightId'],
                    'qty' => $service['qty'],
                    'start' => $service['start'],
                    'end' => $service['end'],
                    'INCid' => $service['INCid'],
                    'incidentalService' => $service['incidentalService'],
                    'remarks' => $service['remarks']
                ));
            }
        }
        /** Calculate SLA Levels */
        $flight = Flight::with('services.tasks.records')->with('tasks')->find($flight->id);
        $flight->services->map(function ($service, $key) use ($flight) {

            $service->tasks->map(function ($task, $key) use ($flight, $service) {

                if ($task->symbol != "") {
                    $date = Carbon::createFromFormat('Y-m-d H:i', $flight->{$task->timeFrom});
                    if ($task->symbol == "-") {
                        $date->subMinutes($task->cutOffTime);
                    } else {
                        $date->addMinutes($task->cutOffTime);
                    }
                    TaskHistory::create(array(
                        'serviceId' => $service->id,
                        'taskId' => $task->id,
                        'flightId' => $flight->id,
                        'cutOffTime' => $date->format('H:i'),
                        'staffNumber' => $task->minimumStaff,
                        'userId' => 0
                    ));
                } else {

                    TaskHistory::create(array(
                        'serviceId' => $service->id,
                        'taskId' => $task->id,
                        'flightId' => $flight->id,
                        'cutOffTime' => null,
                        'staffNumber' => $task->minimumStaff,
                        'userId' => 0
                    ));
                }
            });
        });
        $this->recreateSerials($flight->STA, $flight->turnaroundType, $flight->carrier);
        return redirect()->action('FlightController@show', $flight->id);
    }

    public function recreateSerials($STA, $turnaroundType, $carrier)
    {
        $month = Carbon::createFromFormat('Y-m-d H:i', $STA);
        $startOfMonth = $month->copy()->startOfMonth();
        $endOfMonth = $month->copy()->endOfMonth();

        $flights = Flight::where('flightDate', '>=', $startOfMonth)->where('flightDate', '<=', $endOfMonth)->where('turnaroundType', $turnaroundType)->where('id', '>', 872)->where('carrier', $carrier)->orderBy('STA', 'asc')->get();
        Flight::where('flightDate', '>=', $startOfMonth)->where('flightDate', '<=', $endOfMonth)->where('turnaroundType', $turnaroundType)->where('id', '>', 872)->update(array('serial' => NULL));
        foreach ($flights as $flight) {
            $month = Carbon::createFromFormat('Y-m-d H:i', $flight->STA);
            $startOfMonth = $month->copy()->startOfMonth();
            $count = Flight::withTrashed()->where('STA', '>=', $startOfMonth)->where('STA', '<', $month->toDateTimeString())->where('turnaroundType', $turnaroundType)->where('carrier', $flight->carrier)->count();
            $prefix = 'C';
            if ($flight->turnaroundType == 'Freighter Turnaround') {
                $prefix = 'F';
            } elseif ($flight->turnaroundType == 'Passenger Turnaround') {
                $prefix = 'P';
            }
            $carrier = Carrier::find($flight->carrier)->carrier;
            $sheetNo = $month->format('Ym') . '/' . $carrier . '/' . $prefix . '/' . str_pad($count + 1, 4, "0", STR_PAD_LEFT);
            $flight->serial = $sheetNo;
            Flight::find($flight->id)->update(array('serial' => $sheetNo));
            $flight->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /*

               return  (new ServiceLevelAgreementChecklist($flight))->download('tac.xlsx', \Maatwebsite\Excel\Excel::XLSX);
                dd('h');
        */
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
                    if ($record->cutOffTime) {
                        $task->cutOffTime = $record->cutOffTime;
                    }
                    $task->minimumStaff = $record->staffNumber . '/' . $task->minimumStaff;
                    if ($record->startTime != "" and $record->endTime != "") {
                        $flightDate = $flight->flightDate;
                        $startTime = Carbon::createFromFormat('Y-m-d H:i:s', $flightDate . ' ' . $record->startTime);
                        $endTime = Carbon::createFromFormat('Y-m-d H:i:s', $flightDate . ' ' . $record->endTime);
                        if ($endTime->lessThan($startTime)) {
                            $endTime = $endTime->addDay();
                        }
                        $timing = $endTime->diffInMinutes($startTime);
                        $hours = $endTime->diffInHours($startTime);
                        $milli = $endTime->diffInSeconds($startTime) * 1000;

                        if ($record->cutOffTime != "") {
                            $cutOffTime = Carbon::createFromFormat('Y-m-d H:i:s', $flightDate . ' ' . $record->cutOffTime);
                            if ($startTime->greaterThan($cutOffTime)) {
                                $task->isMilestoneReached = "Started Off Late";
                            }
                        }

                        if ($task->minutesToBeDone != "") {
                            if ($flight->flightType = 'P' && $task->minutesToBeDoneAppliesTo) {
                                if ($timing > $task->minutesToBeDone) {
                                    $task->isMilestoneReached = $task->isMilestoneReached . "/ Delayed";
                                } else {
                                    $task->isMilestoneReached = $task->isMilestoneReached . "/ On Time";
                                }
                            } else {
                                if ($timing > $task->minutesToBeDone) {
                                    $task->isMilestoneReached = $task->isMilestoneReached . "/ Delayed";
                                } else {
                                    $task->isMilestoneReached = $task->isMilestoneReached . "/ On Time";
                                }
                            }

                        }

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


        return view('flights.view_flight')->with(compact('flight'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $incidentalServices = IncidentalServiceList::select(DB::raw('INCid as id'), DB::raw('description as name'))->get();
        $incidentalServices = json_encode($incidentalServices);
        $flight = Flight::with('cx', 'incidentals')->find($id);
        $carrier = $flight->carrier;
        $flightDate = $flight->flightDate;
        $completed = $flight->completed;
        $arrival = $flight->arrival;
        $departure = $flight->departure;
        $STA = $flight->STA;
        $STD = $flight->STD;
        $delayCode = $flight->delayCode;
        $flightType = $flight->flightType;
        $turnaroundType = $flight->turnaroundType;
        $incids = json_encode($flight->incidentals);
        return view('flights.create_flight')->with(compact('incidentalServices', 'incids', 'flightType', 'delayCode', 'turnaroundType', 'flight', 'carrier', 'flightDate', 'arrival', 'departure', 'STA', 'STD', 'completed'));
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
        $flight = Flight::find($id);
        $items = json_decode($request->incidservices);
        IncidentalService::where('flightId', $id)->delete();
        if ($items != null) {
            foreach (json_decode($request->incidservices) as $service) {
                $service = (array)$service;
                $service['flightId'] = $id;
                IncidentalService::firstOrCreate(array(
                    'flightId' => $service['flightId'],
                    'INCid' => $service['INCid'],
                    'qty' => $service['qty'],
                    'start' => $service['start'],
                    'end' => $service['end'],
                    'remarks' => $service['remarks'],

                    'incidentalService' => $service['incidentalService']
                ));
            }
        }

        $flight->update($request->except('incidservices', 'incidentalservice'));
        $flight = Flight::find($id);
        $this->recreateSerials($flight->STA, $flight->turnaroundType, $flight->carrier);
        return redirect()->action('FlightController@show', $flight->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Flight::destroy($id);
        return array('ok' => 'destroyed');
    }

    public function flightDocuments($id, $type)
    {
        if ($type == 'Charge_Sheet') {
            $flight = Flight::find($id);

        } else {

        }

    }
}
