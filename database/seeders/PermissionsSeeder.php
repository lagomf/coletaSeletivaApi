<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //User Permissions
        Permission::create(['name'=>'view users']);
        Permission::create(['name'=>'show users']);
        Permission::create(['name'=>'create users']);
        Permission::create(['name'=>'update users']);
        Permission::create(['name'=>'delete users']);
        Permission::create(['name'=>'restore users']);
        Permission::create(['name'=>'hardDelete users']);
        Permission::create(['name'=>'withTrashed users']);

        //Support Request Permissions
        Permission::create(['name'=>'view supportRequests']);
        Permission::create(['name'=>'create supportRequests']);
        Permission::create(['name'=>'respond supportRequests']);
        Permission::create(['name'=>'update supportRequests']);
        Permission::create(['name'=>'delete supportRequests']);
        Permission::create(['name'=>'restore supportRequests']);
        Permission::create(['name'=>'hardDelete supportRequests']);
        Permission::create(['name'=>'withTrashed supportRequests']);

        //Vehicle Permissions
        Permission::create(['name'=>'view vehicles']);
        Permission::create(['name'=>'show vehicles']);
        Permission::create(['name'=>'create vehicles']);
        Permission::create(['name'=>'update vehicles']);
        Permission::create(['name'=>'delete vehicles']);
        Permission::create(['name'=>'restore vehicles']);
        Permission::create(['name'=>'hardDelete vehicles']);
        Permission::create(['name'=>'withTrashed vehicles']);

        //Admin
        Role::create([
            'name'=>'Super Admin',
            'guard_name'=>'api'
        ]);

        //Citizen
        $roleCitizen = Role::create([
            'name'=>'Citizen',
            'guard_name'=>'api'
        ]);

        $roleCitizen->givePermissionTo([
            'create supportRequests'
        ]);

        //Driver
        $roleDriver = Role::create([
            'name'=>'Driver',
            'guard_name'=>'api'
        ]);

        $roleDriver->givePermissionTo([
            'view vehicles',
            'show vehicles'
        ]);
        //Public Agent
        $roleAgent = Role::create([
            'name'=>'Agent',
            'guard_name'=>'api'
        ]);

        $roleAgent->givePermissionTo([
            'view users',
            'show users',
            'create users',
            'update users',
            'delete users',
            'restore users',

            'view supportRequests',
            'create supportRequests',
            'respond supportRequests',
            'delete supportRequests',
            'restore supportRequests',

            'view vehicles',
            'show vehicles',
            'create vehicles',
            'update vehicles',
            'delete vehicles',
            'restore vehicles',
        ]);
    }
}
