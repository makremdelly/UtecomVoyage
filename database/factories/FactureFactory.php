<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;


$factory->define(App\Models\Facture::class, function (Faker $faker) {
    return [
        'user_id'        => $faker->unique()->numberBetween(1, App\Models\User::count()),
        'hotel_id'      => $faker->numberBetween($min = 1, $max = 20),
        'reservation_id'    => $faker->unique()->numberBetween(1,App\Models\Reservation::count()),
        'payment_method'  => $faker->randomElement($array = array ('visa','paypal')),
        'amount'          => $faker->numberBetween($min = 200, $max = 99990),
        'created_at'    => now(),
        'updated_at'    => now(),
    ];
});
