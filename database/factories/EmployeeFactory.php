<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Administracion\Employee;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'idempleado' => Str::random(4),
        'nombre' => $faker->name,
        'paterno' => $faker->lastName,
        'fuente' => $faker->word,
        'rfc' => Str::random(11),
    ];
});
