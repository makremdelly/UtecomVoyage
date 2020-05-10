<?php

use Faker\Generator as Faker;
use App\Models\Hotel;
use App\Models\Payment;

$factory->define(App\Models\Reservation::class, function (Faker $faker) {
    return [
        // 'user_name'     => $faker->name,
        // 'user_email'    => $faker->email,
        'user_id'         =>$faker->unique()->numberBetween(1, App\Models\user::count()),
        'amount_a_payer'=> $faker->numberBetween($min = 200, $max = 99990),
        'created_at'    => now(),
        'updated_at'    => now(),
        'hotel_id'      => $faker->numberBetween($min = 1, $max = 20),
        'payment_id'    => $faker->unique()->numberBetween(1, App\Models\Payment::count()),
        // 'phone'         => $faker->phoneNumber(),
        'arrival_date'  => now(),
        'departure_date'=> now(),
    ];
});
