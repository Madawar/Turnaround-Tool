<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => 'Dennis Wanyoike',
        'email' => 'dwanyoike@codedcell.com',
        'password' => bcrypt('test123'), // secret
        'administrator' => 1,
        'remember_token' => str_random(10),
    ];
});
