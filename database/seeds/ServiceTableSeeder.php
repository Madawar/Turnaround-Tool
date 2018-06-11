<?php

use Illuminate\Database\Seeder;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = array(
            'Ramp Services ',
            'Passenger Services',
            'Cleaning',
            'Duty Free',
            'Fuelling',
            'Cargo',
            'Flight Operations',
        );

        foreach ($services as $service){
            \App\Service::create(array(
                'service'=>$service,
                'department'=>1,
                'carrierId'=>1
            ));
        }

        $tasks = array(
            array('serviceId'=>'1','task'=>'Position Passenger Steps','timed'=>1),
            array('serviceId'=>'1','task'=>'Supply Power','timed'=>0),
            array('serviceId'=>'1','task'=>'Unload AFT Lower Deck','timed'=>1),
            array('serviceId'=>'1','task'=>'Unload Main Deck','timed'=>1),
            array('serviceId'=>'1','task'=>'Service Lavatories','timed'=>1),
            array('serviceId'=>'1','task'=>'Service Galleys','timed'=>1),
            array('serviceId'=>'1','task'=>'Service Cabin','timed'=>1),
            array('serviceId'=>'1','task'=>'Service Potable Water','timed'=>1),
            array('serviceId'=>'1','task'=>'Unload FWD Lower Lobe','timed'=>1),
            array('serviceId'=>'1','task'=>'Load Main Deck Cargo','timed'=>1),
            array('serviceId'=>'1','task'=>'Load FWD Lower Lobe','timed'=>1),
            array('serviceId'=>'1','task'=>'Power Supply Removal','timed'=>0),
            array('serviceId'=>'1','task'=>'Remove Steps','timed'=>1),
            array('serviceId'=>'1','task'=>'PushBack','timed'=>1),
        );

        foreach ($tasks as $task){
            \App\Task::create($task);
        }

    }
}
