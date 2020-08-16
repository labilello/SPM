<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Repair;
use Faker\Generator as Faker;

$factory->define(Repair::class, function (Faker $faker) {
    return [
        'date_in' => $faker->dateTime('now'),
        'date_out' => null,
        'nro_serie' => $faker->regexify('^[A-Z]{1,2}[A-Z0-9]{9,14}'),

        'product_id' => \App\Product::find($faker->numberBetween(1, 200)),
        'status_id' => 1

    ];
});
