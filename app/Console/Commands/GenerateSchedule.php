<?php

namespace App\Console\Commands;

use App\Carrier;
use App\Flight;
use Carbon\Carbon;
use DB;
use Excel;
use Helper;
use Illuminate\Console\Command;
use PDF;
use RRule\RRule;

class GenerateSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Flight Schedule';

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
        $carrier = $this->anticipate('Which Carrier are you creating a schedule for?', ['EK', 'SV', 'LH']);
        $carrier = Carrier::where('carrier', $carrier)->first();
        $carrierId = $carrier->id;
        $this->info("Carrier ID is " . $carrierId);
        $origin = $this->anticipate('Origin?', ['NBO']);
        $flightNumber = $this->ask('Flight Number?');
        $destination = $this->anticipate('destination?', ['MST', 'AMS']);
        $flightType = $this->choice('Flight Type?', ['F', 'P'], 0);
        $aircraftType = $this->anticipate('Aircraft Type?', ['B777F']);
        $aircraftRegistration = $this->anticipate('Aircraft Registration?', ['A6-EF']); //A6-EFE
        $turnaroundType = $this->choice('Turnaround Type?', ['Freighter Turnaround', 'Passenger Turnaround', 'Freight Transit', 'Passenger Transit'], 0);
        $STA = $this->ask('STA?');
        $STD = $this->ask('STD?');
        $dayOfWeek = $this->choice('Day Of Week?', ['MO', 'TU', 'WE', 'TH', 'FR', 'SA', 'SU'], 0);

        $rrule = new RRule([
            'FREQ' => 'WEEKLY',
            'INTERVAL' => 1,
            'DTSTART' => Carbon::today()->startOfMonth()->format('Y-m-d'),
            'UNTIL' => Carbon::today()->endOfMonth()->format('Y-m-d'),
            'BYDAY' => $dayOfWeek
        ]);

        foreach ($rrule as $occurrence) {
            $flights = Flight::where('flightNo', $flightNumber)->where('flightDate', $occurrence->format('Y-m-d'))->get();
            if (count($flights) > 0) {
                $this->warn('Skipping already created flight');
            } else {
                $flight = Flight::create(
                    array(
                        'carrier' => $carrierId,
                        'flightNo' => $flightNumber,
                        'orig' => $origin,
                        'dest' => $destination,
                        'flightType' => $flightType,
                        'aircraftType' => $aircraftType,
                        'aircraftRegistration' => $aircraftRegistration,
                        'turnaroundType' => $turnaroundType,
                        'flightDate' => $occurrence->format('Y/m/d'),
                        'STA' => Carbon::createFromFormat('Y-m-d Hi', $occurrence->format('Y-m-d') . ' ' . $STA),
                        'STD' => Carbon::createFromFormat('Y-m-d Hi', $occurrence->format('Y-m-d') . ' ' . $STD),
                    )
                );
                $this->warn('Flight Created Successfully');
            }
        }


        $this->call('pdf:create');

    }
}
