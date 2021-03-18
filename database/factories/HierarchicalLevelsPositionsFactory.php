<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Administracion\hierarchical_levels_positions;
use Faker\Generator as Faker;

$factory->define(hierarchical_levels_positions::class, function (Faker $faker) {
    return [
        'level' => $faker->randomDigit,
        'name' => $faker->name,
        'description' => $faker->paragraph,
    ];
});
