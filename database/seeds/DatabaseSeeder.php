<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
         $this->call(CarrierTableSeeder::class);
         $this->call(DepartmentTableSeeder::class);
         $this->call(ServiceTableSeeder::class);
         $this->call(FlightTableSeeder::class);
         $this->call(FullFlightSeeder::class);
    }
}
