<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Administracion\WorkShift;
use Faker\Generator as Faker;

$factory->define(WorkShift::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'start' => $faker->time($format = 'H:i:s', $max = 'now') ,
        'end' => $faker->time($format = 'H:i:s', $max = 'now') ,
    ];
});
