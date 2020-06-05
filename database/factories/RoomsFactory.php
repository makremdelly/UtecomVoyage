<?php

use Faker\Generator as Faker;
use App\Models\Hotel;

$factory->define(App\Models\Room::class, function (Faker $faker) {
    return [
        'name'          => $faker->name, 
        'availibility'  => $faker->numberBetween($min = 0, $max = 1),
        'hotel_id'      => $faker->numberBetween($min = 1, $max = 20),
        'vue'           => $faker->randomElement($array = array ('sur mer','vue 2','vue 3','vue 4','vue 5')),
        'total'         => $faker->numberBetween($min = 10, $max = 500),
        // 'price'         => $faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 1000),
        'type'           => $faker->randomElement($array = array ('Single','Double','Triple','Quad','Queen','King')),
        'description'   => $faker->realText($maxNbChars = 200),
        'persons'       => $faker->numberBetween($min = 1, $max = 4),
        'surface'       => 9.98,
    ];
});
