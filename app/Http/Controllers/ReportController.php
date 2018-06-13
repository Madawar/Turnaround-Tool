<?php

namespace App\Http\Controllers;

use App\Carrier;
use Helper;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Storage;
class ReportController extends Controller
{
    public function index()
    {
        return view('report.monthly_report');
    }

    public function generateReport(Request $request)
    {
        $carrier = Carrier::with(['flights' => function ($query) use ($request) {
            $query->with('tasks.task')->where('flightDate', '>=', $request->from)
                ->where('flightDate', '<=', $request->to)->orderBy('flightDate');
        }])->find($request->carrier);

        $carrier->flights = $carrier->flights->map(function ($item) {
            // $item->flightDate = Helper::parseDate($item->flightDate, 'Y-m-d H:i', 'Y-m-d');
            $item->scheduledDeparture = Helper::parseDate($item->STD, 'Y-m-d H:i', 'H:i');
            $item->scheduledArrival = Helper::parseDate($item->STA, 'Y-m-d H:i', 'H:i');
            $item->ATA = Helper::parseDate($item->arrival, 'Y-m-d H:i', 'H:i');
            $item->ATD = Helper::parseDate($item->departure, 'Y-m-d H:i', 'H:i');

            $item->scheduledDepartureObj = Helper::returnCarbon($item->STD, 'Y-m-d H:i', 'H:i');
            $item->scheduledArrivalObj = Helper::returnCarbon($item->STA, 'Y-m-d H:i', 'H:i');
            $item->ATAObj = Helper::returnCarbon($item->arrival, 'Y-m-d H:i', 'H:i');
            $item->ATDObj = Helper::returnCarbon($item->departure, 'Y-m-d H:i', 'H:i');

            if ($item->ATDObj != null and $item->ATAObj != null) {
                $item->turnaroundTime = $item->ATDObj->diffInMinutes($item->ATAObj);

            }

            if ($item->scheduledDepartureObj != null and $item->scheduledArrivalObj != null) {
                $item->scheduledTurnaroundTime = $item->scheduledDepartureObj->diffInMinutes($item->scheduledArrivalObj);
            }
            $item->result = "";
            $item->airlineDelay = 0;
            $item->timeDelay = 0;
            $item->timeRecovered = 0;
            if ($item->ATDObj != null and $item->ATAObj != null and $item->scheduledDepartureObj != null and $item->scheduledArrivalObj != null) {

                if ($item->ATAObj->greaterThan($item->scheduledArrivalObj)) {
                    $minutes = $item->ATAObj->diffInMinutes($item->scheduledArrivalObj);
                    $item->result = "{$minutes} Minutes Late ATA ";
                    $item->airlineDelay = $minutes;
                } elseif ($item->ATAObj->equalTo($item->scheduledArrivalObj)) {
                    $item->result = "On Time";
                } elseif ($item->ATAObj->lessThan($item->scheduledArrivalObj)) {
                    $minutes = $item->scheduledArrivalObj->diffInMinutes($item->ATAObj);
                    $item->result = "{$minutes} Minutes Early ATA ";
                }

                if ($item->turnaroundTime < $item->scheduledTurnaroundTime or $item->turnaroundTime == $item->scheduledTurnaroundTime) {
                    $latetime = ($item->scheduledTurnaroundTime) - $item->turnaroundTime;
                    $item->result = $item->result . "<br/> Turnarond in {$item->turnaroundTime} Minutes, {$latetime} Minutes Recovered";
                    $item->timeRecovered = $latetime;
                    $item->delay = "early";
                }

                if ($item->turnaroundTime > $item->scheduledTurnaroundTime) {
                    $latetime = ($item->turnaroundTime) - $item->scheduledTurnaroundTime;
                    $item->result = $item->result . "<br/> {$latetime} Minutes Delay ATD";
                    $item->timeDelay = $latetime;
                    $item->delay = "delayed";
                }
            }

            return $item;
        });

        $from = $request->from;
        $to = $request->to;
        $reportName = $request->reportName;
        if ($request->ajax()) {
            $name = str_slug($carrier->carrier . ' ' . $from . ' ' . $to);
            $pdf = PDF::setOptions(['dpi' => 150, 'defaultPaperSize' => 'a4'])
                ->loadView("report.{$request->reportName}", compact('carrier','request', 'from', 'to'));
            $pdf->save(storage_path("app/public/{$name}.pdf"));
            return array('file'=>Storage::url($name . '.pdf'));
        }
        $ajaxObj = json_encode(array('carrier' => $carrier->id, 'from' => $from, 'to' => $to, 'reportName'=>$request->reportName));
        return view('report.monthly_report')->with(compact('carrier', 'request', 'from', 'to','ajaxObj','reportName'));
    }
}
