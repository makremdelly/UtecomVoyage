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
        Permission::create(['name' => 'acces-superadmin']);
        Permission::create(['guard_name' => 'api', 'name' => 'acces-client']);
        # roles
        Role::create(['name' => 'Administrator'])->givePermissionTo('acces-admin');
        Role::create(['name' => 'Super-administrator'])->givePermissionTo('acces-superadmin');
        Role::create(['guard_name' => 'api', 'name' => 'Client'])->givePermissionTo('acces-client');
    }
}
