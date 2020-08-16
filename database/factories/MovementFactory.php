<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Movement;
use Faker\Generator as Faker;

$factory->define(Movement::class, function (Faker $faker) {
    return [
//        'user_id' => 1,
//        'product_id' => \App\ProductController::find($faker->numberBetween(1, 200))->codigo_unix,
//        'type_id' => \App\Status::find($faker->numberBetween(1, 2))->id,
    ];
});
