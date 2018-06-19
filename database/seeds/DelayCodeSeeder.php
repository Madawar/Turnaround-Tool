<?php

use Illuminate\Database\Seeder;

class DelayCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path() . '/delay_codes.csv';
        $csvFile = file($path);
        $data = [];
        $faker = Faker\Factory::create();
        foreach ($csvFile as $line) {
            $delayCode = \App\DelayCode::create(array(
                'delayNumber' => str_getcsv($line)[0],
                'delayAbbreviation' => str_getcsv($line)[1],
                'delayDescription' => str_getcsv($line)[2],

            ));
        }
    }
}
