<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FullFlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carrier = \App\Carrier::find(1);
        $faker = Faker\Factory::create();

        for ($x = 0; $x <= 50; $x++) {
            $date = Carbon::today();
            $dte =$faker->numberBetween(1, 10);
            $flightDate = $date->subDay($dte);
            $TA = $faker->numberBetween(1, 10);
            $TD = $faker->numberBetween(2, 3);
            $STA = Carbon::today()->subDay($dte)->addHours($TA);
            $STD = Carbon::today()->subDay($dte)->addHours($TA+$TD);
            $lateOrEarly = $faker->boolean();
            $lateOrEarly2 = $faker->boolean();

            if ($lateOrEarly == 1) {
                $arrival = Carbon::today()->addHours($TA)->subDay($dte)->addMinutes($faker->numberBetween(0, 50));
            } else {
                $arrival = Carbon::today()->addHours($TA)->subDay($dte)->subMinutes($faker->numberBetween(0, 50));
            }

            if ($lateOrEarly2 == 1) {
                $departure = Carbon::today()->addHours($TA+$TD)->subDay($dte)->addMinutes($faker->numberBetween(0, 50));
            } else {
                $departure = Carbon::today()->addHours($TA+$TD)->subDay($dte)->subMinutes($faker->numberBetween(0, 30));
            }


            \App\Flight::create(array(
                'carrier' => $carrier->id,
                'flightNo' => $faker->numberBetween(9102, 9777),
                'flightDate' => $flightDate,
                'STA' => $STA,
                'STD' => $STD,
                'arrival' => $arrival,
                'departure' => $departure,
            ));
        }

    }
}
