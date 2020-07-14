<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\Voyage::class, function (Faker $faker) {
    return [
        'type'          => $faker->randomElement($array = array('Voyages organisés', 'carte', 'Circuit Sud', 'Circuit Nord', 'Croisière', 'séjour', 'عمرة')),
        'NbPlace' => $faker->numberBetween($min = 1, $max = 500),
        'villeD'    => $faker->country,
        'depart'    => $faker->country,
        'hotel_id'      => $faker->numberBetween($min = 1, $max = 20),
        // 'autocar_id'    => $faker->unique()->numberBetween(1, App\Models\Payment::count()),
        'prix' => $faker->numberBetween($min = 200, $max = 99990),
        'startDate'  => $faker->dateTimeThisDecade,
        'endDate' => $faker->dateTimeThisDecade,
        'description' => $faker->realText($maxNbChars = 200),
        'retour'    => $faker->country,
        'created_at'    => now(),
        'updated_at'    => now(),
    ];
});
