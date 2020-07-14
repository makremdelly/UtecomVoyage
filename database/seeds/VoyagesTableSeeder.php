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
        factory(App\Models\Voyage::class, 20)->create();

        
        // voyage::create([
        //     'titre'              => 'tunis', 
        //     'type_id'             => 'Omra',
        //     'description'       => 'this is a test voyages with no rooms and reservations',
        //     'created_at'        => now(),
        //     'updated_at'        => now(),
        // ]);
        // voyage::create([
        //     'titre'              => 'voyage 2', 
        //     'type_id'             => 'tunis',
        //     'description'       => 'this is a test voyages with no rooms and reservations',
        //     'created_at'        => now(),
        //     'updated_at'        => now(),
        // ]);
     
    }

    }

