<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Administracion\Gender;
use Faker\Generator as Faker;

$factory->define(Gender::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});
