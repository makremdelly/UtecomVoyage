<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\Offer::class, function (Faker $faker) {
    return [
        'price'      => $faker->numberBetween($min = 200, $max = 99990),
        'discount'   => $faker->randomElement($array = array ('discount' => $faker->numberBetween($min = 200, $max = 80000),NULL)),
        // 'hotel_id'      => $faker->null,
        'room_id'      => $faker->unique()->numberBetween(1, App\Models\Room::count()),
        // 'voyage_id'      => $faker->null,
        'created_at'    => now(),
        'updated_at'    => now(),    ];
});
