<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Hotel::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'stars' => $faker->numberBetween($min = 1, $max = 5),
        'phone' =>  $faker->tollFreePhoneNumber,
        'description' => $faker->realText($maxNbChars = 1000),
        'address' => $faker->address,
        'laltitude' => $faker->latitude($min = -90, $max = 90) ,
        'longitude' => $faker->longitude($min = -180, $max = 180),
        'country' => $faker->country,
        'city' => $faker->city,
        'postcode' => $faker->postcode,
        'administrative' => $faker->text($maxNbChars = 10),
        'type' => $faker->text($maxNbChars = 10),            
        'created_at' => now(),
        'updated_at' => now(),
    ];  
});
