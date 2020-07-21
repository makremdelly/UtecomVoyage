<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesPermissionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(HotelsTableSeeder::class);
        $this->call(PaymentsTableSeeder::class);
        $this->call(RoomsTableSeeder::class);
        $this->call(ReservationsTableSeeder::class);
        $this->call(MediasTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(SubscriptionsTableSeeder::class);
        $this->call(VoyagesTableSeeder::class);
        $this->call(AutocarsTableSeeder::class);
        $this->call(FacturesTableSeeder::class);

    }
}
