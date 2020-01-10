<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Administracion\Role;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence
    ];
});
