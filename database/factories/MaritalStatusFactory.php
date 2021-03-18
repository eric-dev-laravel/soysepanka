<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Administracion\MaritalStatus;
use Faker\Generator as Faker;

$factory->define(MaritalStatus::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});
