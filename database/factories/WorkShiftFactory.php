<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Administracion\WorkShift;
use Faker\Generator as Faker;

$factory->define(WorkShift::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'up_start' => $faker->time($format = 'H:i:s', $max = 'now') ,
        'up_end' => $faker->time($format = 'H:i:s', $max = 'now') ,
        'down_start' => $faker->time($format = 'H:i:s', $max = 'now') ,
        'down_end' => $faker->time($format = 'H:i:s', $max = 'now') ,
    ];
});
