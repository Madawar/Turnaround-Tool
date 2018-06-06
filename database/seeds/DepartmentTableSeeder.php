<?php

use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Department::create(array(
            'department' => 'Ramp',
            'email' => 'ramp@afske.aero'
        ));
    }
}
