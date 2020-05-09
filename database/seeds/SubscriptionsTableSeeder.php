<?php

use Illuminate\Database\Seeder;
use App\Models\Subscription;

class SubscriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subscription::create([
            'user_id'               => 3, 
            'hotel_id'              => 12,
            'history_id'            => 5,
            'status'                => 'paye',
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        Subscription::create([
            'user_id'               => 8, 
            'hotel_id'              => 10,
            'history_id'            => 8,
            'status'                => 'non payé',
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        Subscription::create([
            'user_id'               => 20, 
            'hotel_id'              => 1,
            'history_id'            => 12,
            'status'                => 'en retard',
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
    }
}
