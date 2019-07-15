<?php

use Faker\Generator as Faker;
use App\Transaction;

$factory->define(Transaction::class, function(Faker $faker) {
    return [
        'client_id' => function() {
            return factory(App\Client::class)->create()->id;
        },
        'order_amount' => $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 1000),
        'order_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
    ];
});
