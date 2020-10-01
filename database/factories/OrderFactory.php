<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(2,7),
        'total_price' => $faker->randomNumber(),
        'invoice_number' => $faker->randomNumber(),
        'status'=>'PROCESS',
    ];
});
