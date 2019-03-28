<?php

namespace App\Console;

use App\Console\Commands\CreatePdf;
use App\Console\Commands\GeneratePdfs;
use App\Console\Commands\GenerateSchedule;
use App\Console\Commands\PushData;
use App\Console\Commands\SyncTarrif;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
       Commands\BuildForm::class,
        PushData::class,
        GeneratePdfs::class,
        GenerateSchedule::class,
        CreatePdf::class,
        SyncTarrif::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->command('afs:tarrif')->everyFifteenMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
