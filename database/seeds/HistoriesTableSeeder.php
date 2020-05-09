<?php

use Illuminate\Database\Seeder;
use App\Models\History;

class HistoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        
        factory(App\Models\History::class, 50)->create();



    //     // first history
    //     History::create([
    //         'user_id'               => 3, 
    //         'hotel_id'              => 12,
    //         'payment_method'        => 'visa',
    //         'amount'                => 5300,
    //         'created_at'            => '2019-02-01 05:14:21',
    //         'updated_at'            => now(),
    //         'subscription_id'       => 1,
    //     ]);
    //     History::create([
    //         'user_id'               => 3, 
    //         'hotel_id'              => 12,
    //         'payment_method'        => 'visa',
    //         'amount'                => 5300,
    //         'created_at'            => '2019-03-01 05:14:21',
    //         'updated_at'            => now(),
    //         'subscription_id'       => 1,
    //     ]);
    //     History::create([
    //         'user_id'               => 3, 
    //         'hotel_id'              => 12,
    //         'payment_method'        => 'visa',
    //         'amount'                => 5300,
    //         'created_at'            => '2019-04-01 05:14:21',
    //         'updated_at'            => now(),
    //         'subscription_id'       => 1,
    //     ]);
    //     History::create([
    //         'user_id'               => 3, 
    //         'hotel_id'              => 12,
    //         'payment_method'        => 'visa',
    //         'amount'                => 5300,
    //         'created_at'            => '2019-05-01 05:14:21',
    //         'updated_at'            => now(),
    //         'subscription_id'       => 1,
    //     ]);
    //     History::create([
    //         'user_id'               => 3, 
    //         'hotel_id'              => 12,
    //         'payment_method'        => 'visa',
    //         'amount'                => 5300,
    //         'created_at'            => '2019-06-01 05:14:21',
    //         'updated_at'            => now(),
    //         'subscription_id'       => 1,
    //     ]);
    //     // second history
    //     History::create([
    //         'user_id'               => 8, 
    //         'hotel_id'              => 10,
    //         'payment_method'        => 'paypal',
    //         'amount'                => 5300,
    //         'created_at'            => '2019-01-10 05:14:21',
    //         'updated_at'            => now(),
    //         'subscription_id'       => 2,
    //     ]);
    //     History::create([
    //         'user_id'               => 8, 
    //         'hotel_id'              => 10,
    //         'payment_method'        => 'paypal',
    //         'amount'                => 5300,
    //         'created_at'            => '2019-02-10 05:14:21',
    //         'updated_at'            => now(),
    //         'subscription_id'       => 2,
    //     ]);
    //     History::create([
    //         'user_id'               => 8, 
    //         'hotel_id'              => 12,
    //         'payment_method'        => 'paypal',
    //         'amount'                => 5300,
    //         'created_at'            => '2019-03-10 05:14:21',
    //         'updated_at'            => now(),
    //         'subscription_id'       => 2,
    //     ]);
    //     // thrid history
    //     History::create([
    //         'user_id'               => 20, 
    //         'hotel_id'              => 1,
    //         'payment_method'        => 'visa',
    //         'amount'                => 5300,
    //         'created_at'            => '2019-02-05 05:14:21',
    //         'updated_at'            => now(),
    //         'subscription_id'       => 3,
    //     ]);
    //     History::create([
    //         'user_id'               => 20, 
    //         'hotel_id'              => 1,
    //         'payment_method'        => 'visa',
    //         'amount'                => 5300,
    //         'created_at'            => '2019-03-04 05:14:21',
    //         'updated_at'            => now(),
    //         'subscription_id'       => 3,
    //     ]);
    //     History::create([
    //         'user_id'               => 20, 
    //         'hotel_id'              => 1,
    //         'payment_method'        => 'visa',
    //         'amount'                => 5300,
    //         'created_at'            => '2019-04-04 05:14:21',
    //         'updated_at'            => now(),
    //         'subscription_id'       => 3,
    //     ]);
    //     History::create([
    //         'user_id'               => 20, 
    //         'hotel_id'              => 1,
    //         'payment_method'        => 'visa',
    //         'amount'                => 5300,
    //         'created_at'            => '2019-05-05 05:14:21',
    //         'updated_at'            => now(),
    //         'subscription_id'       => 3,
    //     ]);
    }
}
