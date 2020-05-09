<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # permissions
        Permission::create(['name' => 'acces-admin']);
        Permission::create(['guard_name' => 'api', 'name' => 'acces-hotelier']);
        # roles
        Role::create(['name' => 'Administrator'])->givePermissionTo('acces-admin');
        Role::create(['guard_name' => 'api', 'name' => 'Hotelier'])->givePermissionTo('acces-hotelier');
    }
}
