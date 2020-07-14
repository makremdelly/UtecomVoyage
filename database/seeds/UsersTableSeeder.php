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
        ->assignRole('Super-administrator');

        User::create([
            'name'              => 'Makrem', 
            'last_name'         => 'Delly',
            'email'             => 'makrem@utecom.com', 
            'password'          => Hash::make('makrem1234')
        ])
        ->assignRole('Administrator');

        User::create([
            'name'              => 'helmi', 
            'last_name'         => 'delly',
            'email'             => 'helmi@utecom.com', 
            'password'          => Hash::make('helmi1234')
        ])
        ->assignRole('Administrator');

        User::create([
            'name'              => 'anis', 
            'last_name'         => 'delly',
            'email'             => 'anis@utecom.com', 
            'password'          => Hash::make('anis1234')
        ])
        ->assignRole('Administrator');

        factory(App\Models\User::class, 50)->create();
        
    }
    
}
