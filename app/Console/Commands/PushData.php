<?php

namespace App\Console\Commands;

use App\Flight;
use Carbon\Carbon;
use DB;
use Illuminate\Console\Command;

class PushData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'afs:push';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $flights = Flight::all();
        foreach ($flights as $flight) {
            $aircraftType = DB::connection('sqlsrv')->table('RMP_aircraftType')->where('aircraftType', $flight->aircraftType)->first();
            if (count($aircraftType) > 0) {

            } else {
                $aircraftType = DB::connection('sqlsrv')->table('RMP_aircraftType')->insertGetId(
                    array(
                        'aircraftType' => $flight->aircraftType,
                    )
                );
            }

            //Service ID
            $service = DB::connection('sqlsrv')->table('RMP_SERVICES')->where('description', $flight->turnaroundType)->first();
            if (count($service) > 0) {
                $serviceId = $service->serviceId;
            } else {
                $service = DB::connection('sqlsrv')->table('RMP_SERVICES')->insertGetId(
                    array(
                        'description' => $flight->turnaroundType,
                    )
                );
                $serviceId = $service;
            }


            DB::connection('sqlsrv')->table('RMP_FLIGHT')->insert(
                array(
                    'carrier' => $flight->cx->carrier,
                    'flightNumber' => $flight->flightNo,
                    'flightDate' => $flight->flightDate,
                    'aircraftType' => $flight->aircraftType,
                    'serviceId' => $serviceId,
                    'org' => $flight->orig,
                    'dest' => $flight->dest,
                    'ATA' => $flight->arrival,
                    'ATD' => $flight->departure,
                    'STD' => $flight->STD,
                    'STA' => $flight->STA,
                    'aircraftRegistration' => $flight->aircraftRegistration,
                    'source' => 'TAC TOOL',
                    'oper' => 'DWANYOIKE',
                    'datetime' => Carbon::now(),
                    'flightType'=>$flight->flightType
                )
            );
        }


    }
}
