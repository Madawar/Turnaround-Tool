<?php

use Illuminate\Database\Seeder;

class FlightTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create();

        \App\Flight::create(array(
            'carrier' => 1,
            'flightNo' => '9753',
            'flightDate' => \Carbon\Carbon::today()->format('Y-m-d'),
            'arrival' => \Carbon\Carbon::now(),
            'STA' => \Carbon\Carbon::now()->addHours(3)
        ));

        \App\Flight::create(array(
            'carrier' => 1,
            'flightNo' => '9433',
            'flightDate' => \Carbon\Carbon::today()->subDay()->format('Y-m-d'),
            'arrival' => \Carbon\Carbon::now(),
            'STA' => \Carbon\Carbon::now()->addHours(3)
        ));
        \App\Flight::create(array(
            'carrier' => 1,
            'flightNo' => '9123',
            'flightDate' => \Carbon\Carbon::today()->addDay()->format('Y-m-d'),
            'arrival' => \Carbon\Carbon::now(),
            'STA' => \Carbon\Carbon::now()->addHours(3)
        ));
    }
}
