<?php

namespace App\Console\Commands;

use App\IncidentalServiceList;
use Illuminate\Console\Command;
use DB;
class SyncTarrif extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'afs:tarrif';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Tarrif Between AFS and TAC';

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
        $services = DB::connection('sqlsrv')->table('RMP_INCIDSERV')->get();
        foreach ($services as $service) {
            $incid = IncidentalServiceList::firstOrCreate(array('INCid' => $service->INCid));
            $incid->update(array(
                'description' => $service->description,
                'REMARKS' => $service->REMARKS,
                'uom'=>$service->MeasureType
            ));
        }
    }
}
