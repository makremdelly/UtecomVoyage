<?php

use Illuminate\Database\Seeder;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Reservation::class, 40)->create()->each(function($reservation){
            for ($i=0; $i < 5 ; $i++) { 
                $reservation->rooms()->attach(App\Models\Room::all()->random());
            }
        });;
    }
}
