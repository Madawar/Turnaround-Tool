<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Flight;
use DB;
use Helper;
use PDF;
use Illuminate\Support\Facades\File;

class GeneratePdfs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pdf:generate';

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
        $flights = Flight::with('services.tasks.records')->get();
        foreach ($flights as $flight){
            $charge_sheet = str_slug($flight->cx->carrier . ' ' . $flight->flightNo . ' ' . $flight->flightDate).'_chargesheet';
            $exists = File::exists(storage_path("app/public/{$charge_sheet}.pdf"));
            if(!$exists){
                $pdf = PDF::setOptions(['dpi' => 150, 'defaultPaperSize' => 'a4', 'isRemoteEnabled' => true])
                    ->loadView('report.charge_sheet', compact('flight'));
                $pdf->save(storage_path("app/public/{$charge_sheet}.pdf"));
            }
        }

    }
}
