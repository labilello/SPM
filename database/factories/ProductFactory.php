<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'descripcion' => $faker->sentence(5),
        'marca' => $faker->sentence(1),
        'familia' => $faker->sentence(1),
        'codigo_barras' => $faker->ean13,
        'codigo_unico' => 'R-' . $faker->randomNumber(6),
        'costo_reposicion' => $faker->randomFloat(2, 100,5000),
        'iva' => $faker->randomFloat(2, 0, 0.5)
    ];
});
