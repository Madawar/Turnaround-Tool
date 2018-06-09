<?php

namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;
use Storage;

class BuildForm extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'form:build {table}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Build a Form';

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

        $data = "";
        $tcolumns = "";
        $table = $this->argument('table');
        $columns = DB::getSchemaBuilder()->getColumnListing($this->argument('table'));
        $i = 0;
        $data = $data."<row>\r\n";
        foreach ($columns as $column) {
            $this->info("Generating Form Element for {$column} ...");
            $placeholder = $this->ask('Please Enter Text for Placeholder');
            $title = $this->ask('Please Enter Title For Input');
            $icon = $this->ask('Please Specify Font-Awesome Icon');

            $vars = array(
                '{$title}' => $title,
                '{$name}' => $column,
                '{$placeholder}' => $placeholder,
                '{$icon}' => $icon,
            );
            $file = $this->choice('What is your name?', ['input', 'select', 'datepicker', 'datetime'], 0);
            $contents = Storage::get("forms/{$file}.txt");
            $tcolumn = Storage::get("forms/columns.txt");
            $contents = "<div class='col-md-6'>\r\n".strtr($contents, $vars)."</div>\r\n";
            $tcolumns = $tcolumns.strtr($tcolumn, $vars);
            $data = $data.$contents;
            $i++;
            if ($i % 2 == 0 && $i != count($columns)) {
                $data= $data."</row>\r\n<row>";
            }
            if ($this->confirm('Do you wish to Stop?')) {
                break;
            }
        }
        Storage::put("forms/output/{$table}.txt", $data."\r\n".$tcolumns);
    }
}
