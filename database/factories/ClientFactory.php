<?php

use Faker\Generator as Faker;
use App\Client;

$factory->define(Client::class, function(Faker $faker) {
    return [
        'name' => $faker->firstNameMale,
        'lastname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
    ];
});
