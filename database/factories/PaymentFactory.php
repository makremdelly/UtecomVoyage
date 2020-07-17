<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Payment::class, function (Faker $faker) {
    return [
        // 'amount' => $faker->numberBetween($min = 200, $max = 99990),
        'amount'   => $faker->randomElement($array = array ('amount' => $faker->numberBetween($min = 200, $max = 99990),NULL)),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
