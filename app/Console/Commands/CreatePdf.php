<?php

namespace App\Console\Commands;

use App\Flight;
use Carbon\Carbon;
use DB;
use Excel;
use Helper;
use Illuminate\Console\Command;
use PDF;

class CreatePdf extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pdf:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create and Combine PDFs';

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
        $pdfmerge = new \Rainstreamweb\LaraPdfMerger\PdfManage;
        $flights = Flight::where('flightDate', '>=', Carbon::today()->startOfMonth())->where('flightDate', '<=', Carbon::today()->endOfMonth())->orderBy('flightDate', 'asc')->limit(2)->get();
        Flight::where('flightDate', '>=', Carbon::today()->startOfMonth())->where('flightDate', '<=', Carbon::today()->endOfMonth())->update(array('serial' => NULL));
        foreach ($flights as $flight) {
            $month = Carbon::createFromFormat('Y-m-d', $flight->flightDate);
            $startOfMonth = $month->copy()->startOfMonth();
            $count = Flight::where('flightDate', '>=', $startOfMonth)->where('flightDate', '<', $month->toDateString())->where('carrier', $flight->carrier)->count();
            $sheetNo = $month->format('Ym') . str_pad($count + 1, 4, "0", STR_PAD_LEFT);
            $flight->serial = $sheetNo;
            Flight::find($flight->id)->update(array('serial' => $sheetNo));
            $flight = Flight::with('services.tasks.records')->with('tasks')->find($flight->id);
            $charge_sheet = str_slug($flight->cx->carrier . ' ' . $flight->flightNo . ' ' . $flight->flightDate) . '_chargesheet';
            //$exists = File::exists(storage_path("app/public/{$charge_sheet}.pdf"));

            $pdf = PDF::setOptions(['dpi' => 150, 'defaultPaperSize' => 'a4', 'isRemoteEnabled' => true])
                ->loadView('report.charge_sheet_cli', compact('flight'));
            $pdf->save(storage_path("app/public/{$charge_sheet}.pdf"));


            $this->warn('Flight Charge Sheet Created');

            $pdfmerge->addPDF(storage_path("app/public/{$charge_sheet}.pdf"), 'all');
        }
        $month = Carbon::today()->format('F');
        $this->warn('Combining Pdfs');
        $pdfmerge->merge('file', storage_path("app/public/{$month}_ChargeSheets.pdf"));
    }
}
