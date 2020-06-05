<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'              => 'admin', 
            'last_name'         => 'admin',
            'email'             => 'admin@utecom.com', 
            'password'          => Hash::make('password')
        ])
        ->assignRole('Administrator');
        factory(App\Models\User::class, 50)->create();
        
    }
    
}
