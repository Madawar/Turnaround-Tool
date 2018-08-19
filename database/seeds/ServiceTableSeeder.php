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
        );

        foreach ($services as $service) {
            \App\Service::create(array(
                'service' => $service,
                'department' => 1,
                'carrierId' => 1
            ));
        }
        $AFS = array('PARKING BAY ESTABLISHED & CHECKED (FOD)',
            'EQUIPMENT READY AT PARKING BAY (within ERA)',
            'MANPOWER READY AT PARKING BAY',
            'AIRCRAFT ON CHOCKS & CONES CORRECTLY PLACED',
            'PASSENGER STEP MARSHALLED & POSITIONED',
            'MAIN-DECK LOADER MARSHALLED & POSITIONED',
            'LOWER-DECK LOADER MARSHALLED & POSITIONED',
            'CARGO HOLDS/SILLS & BARRIER NETS CHECKED',
            'OFFLOADING COMMENCES',
            'TRANSIT UNITS ONBOARD CHECKED (where applicable)',
            'IMPORT UNITS INSPECTED & RELEASED TO WAREHOUSE',
            'LIR RECEIVED ON TIME',
            'ALL JOINING CARGO/MAIL UNITS ON RAMP ON TIME',
            'ULDS CONDITION CHECKED/PALLET CONTOURS CHECKED',
            'DGR PROPERLY BUILT & LABELED (where applicable)',
            'REGULATIONS ON SPECIAL CARGO CHECKED',
            'GSE GUIDE RAILS, GUARD RAILS & HAND RAILS CHECKED',
            'LOADING COMMENCED & COMPLETED',
            'CATERING COMPLETED ON TIME',
            'FLIGHT CREW ARRIVED ON TIME',
            'FUELING COMPLETED ON TIME',
            'ALL RESTRAINTS (LOCKS & NETS) PROPERLY SECURED',
            'HOLD DOORS CLOSED & CHECKED',
            'FLIGHT DOCUMENTS DELIVERED ON TIME',
            'PASSENGER DOOR CLOSED',
            'AIRCRAFT CLEARED OF ALL SERVICE & LOADING GSE',
            'PUSH BACK TUG POSITONED ON TIME',
            'WALK AROUND CHECKS PERFORMED BEFORE PUSH-OUT',
            'FLIGHT PUSHED OUT ON TIME',
            'POST-DEPARTURE MESSAGES DISPATCHED ON TIME',
            'AIRCRAFT LOADED',
        );
        $tasks = array(
            array('serviceId' => '1', 'task' => 'Position Passenger Steps', 'timed' => 1),
            array('serviceId' => '1', 'task' => 'Supply Power', 'timed' => 0),
            array('serviceId' => '1', 'task' => 'Unload AFT Lower Deck', 'timed' => 1),
            array('serviceId' => '1', 'task' => 'Unload Main Deck', 'timed' => 1),
            array('serviceId' => '1', 'task' => 'Service Lavatories', 'timed' => 1),
            array('serviceId' => '1', 'task' => 'Service Galleys', 'timed' => 1),
            array('serviceId' => '1', 'task' => 'Service Cabin', 'timed' => 1),
            array('serviceId' => '1', 'task' => 'Service Potable Water', 'timed' => 1),
            array('serviceId' => '1', 'task' => 'Unload FWD Lower Lobe', 'timed' => 1),
            array('serviceId' => '1', 'task' => 'Load Main Deck Cargo', 'timed' => 1),
            array('serviceId' => '1', 'task' => 'Load FWD Lower Lobe', 'timed' => 1),
            array('serviceId' => '1', 'task' => 'Power Supply Removal', 'timed' => 0),
            array('serviceId' => '1', 'task' => 'Remove Steps', 'timed' => 1),
            array('serviceId' => '1', 'task' => 'PushBack', 'timed' => 1),
        );
        /*
                foreach ($tasks as $task) {
                    \App\Task::create($task);
                }
                */
        foreach ($AFS as $task) {
            \App\Task::create(array(
                'task' => $task,
                'serviceId' => 1,
                'timed' => 1
            ));
        }

    }
}
