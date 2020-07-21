<?php

use Illuminate\Database\Seeder;
use App\Models\Hotel;

class HotelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Hotel::class, 20)->create()->each(function($hotel){
            for ($i=0; $i < 8 ; $i++) { 
                $hotel->users()->attach(App\Models\User::all()->except(1)->random());
            }
        });
        Hotel::create([
            'name'              => 'Hotel test 0 0', 
            'stars'             => '3',
            'phone'             => '3434-3242-3421', 
            'description'       => 'this is a test hotel with no rooms and reservations',
            'address'           => '34 St.flak',
            // 'laltitude'         => '',
            // 'longitude'         => '',
            'country'           => 'Tunisia',
            // 'administrative'    => 'test',
            'city'              => 'sousse',
            'postcode'          => '3245',
            'type'              => 'test',
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);
        Hotel::create([
            'name'              => 'Hotel test 2', 
            'stars'             => '4',
            'phone'             => '3434-3242-3421', 
            'description'       => 'this is a test hotel with no rooms and reservations and only one picture',
            'address'           => '34 St.flak',
            // 'laltitude'         => '',
            // 'longitude'         => '',
            'country'           => 'Tunisia',
            // 'administrative'    => 'test',
            'city'              => 'sousse',
            'postcode'          => '3245',
            'type'              => 'test',
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);
    }
}
