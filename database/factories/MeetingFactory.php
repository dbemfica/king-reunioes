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

$factory->define(App\Models\Meeting::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'room_id' => 1,
        'date_time' => '2017-10-29 00:00:00',
        'name' => 'Meeting 1',
        'description' => 'test description'
    ];
});
