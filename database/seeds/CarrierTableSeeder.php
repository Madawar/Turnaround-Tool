<?php

use Illuminate\Database\Seeder;

class CarrierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Carrier::create(array(
            'carrier' => 'EK'
        ));
    }
}
