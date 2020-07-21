<?php

use Illuminate\Database\Seeder;
use App\Models\Voyage;



class VoyagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Voyage::class, 20)->create()->each(function($voyage){
            for ($i=0; $i < 1 ; $i++) { 
                $voyage->reservations()->attach(App\Models\Reservation::all()->random());
            }   
            });
        }
    }
        
    