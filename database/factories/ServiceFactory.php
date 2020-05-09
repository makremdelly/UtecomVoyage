<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Service::class, function (Faker $faker) {
    return [
        'name'           => $faker->randomElement($array = array ('WIFI','ascenseur','Salle de Sport','Parking','jardin')),
        'hotel_id'      => $faker->numberBetween($min = 1, $max = 20),
        'description'   => $faker->text($maxNbChars = 200),
        'icon'          => $faker->randomElement($array = array ('fas fa-wifi','fas fa-swimmer','fas fa-gamepad','fas fa-tree','fas fa-parking')),
        'created_at'    => now(),
        'updated_at'    => now(),
    ];
});
