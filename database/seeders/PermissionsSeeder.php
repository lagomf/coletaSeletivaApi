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
        //Role Permissions
        Permission::create(['name'=>'view roles']);

        //User Permissions
        Permission::create(['name'=>'view users','guard_name'=>'api']);
        Permission::create(['name'=>'show users','guard_name'=>'api']);
        Permission::create(['name'=>'create users','guard_name'=>'api']);
        Permission::create(['name'=>'update users','guard_name'=>'api']);
        Permission::create(['name'=>'delete users','guard_name'=>'api']);
        Permission::create(['name'=>'restore users','guard_name'=>'api']);
        Permission::create(['name'=>'hardDelete users','guard_name'=>'api']);
        Permission::create(['name'=>'withTrashed users','guard_name'=>'api']);

        //Support Request Permissions
        Permission::create(['name'=>'view supportRequests','guard_name'=>'api']);
        Permission::create(['name'=>'create supportRequests','guard_name'=>'api']);
        Permission::create(['name'=>'respond supportRequests','guard_name'=>'api']);
        Permission::create(['name'=>'update supportRequests','guard_name'=>'api']);
        Permission::create(['name'=>'delete supportRequests','guard_name'=>'api']);
        Permission::create(['name'=>'restore supportRequests','guard_name'=>'api']);
        Permission::create(['name'=>'hardDelete supportRequests','guard_name'=>'api']);
        Permission::create(['name'=>'withTrashed supportRequests','guard_name'=>'api']);

        //Vehicle Permissions
        Permission::create(['name'=>'view vehicles','guard_name'=>'api']);
        Permission::create(['name'=>'show vehicles','guard_name'=>'api']);
        Permission::create(['name'=>'create vehicles','guard_name'=>'api']);
        Permission::create(['name'=>'update vehicles','guard_name'=>'api']);
        Permission::create(['name'=>'delete vehicles','guard_name'=>'api']);
        Permission::create(['name'=>'restore vehicles','guard_name'=>'api']);
        Permission::create(['name'=>'hardDelete vehicles','guard_name'=>'api']);
        Permission::create(['name'=>'withTrashed vehicles','guard_name'=>'api']);

        //Route Permissions
        Permission::create(['name'=>'view routes','guard_name'=>'api']);
        Permission::create(['name'=>'show routes','guard_name'=>'api']);
        Permission::create(['name'=>'create routes','guard_name'=>'api']);
        Permission::create(['name'=>'update routes','guard_name'=>'api']);
        Permission::create(['name'=>'delete routes','guard_name'=>'api']);
        Permission::create(['name'=>'restore routes','guard_name'=>'api']);
        Permission::create(['name'=>'hardDelete routes','guard_name'=>'api']);
        Permission::create(['name'=>'withTrashed routes','guard_name'=>'api']);

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
            'respond supportRequests',
            'delete supportRequests',
            'restore supportRequests',

            'view vehicles',
            'show vehicles',
            'create vehicles',
            'update vehicles',
            'delete vehicles',
            'restore vehicles',

            'view routes',
            'show routes',
            'create routes',
            'update routes',
            'delete routes',
            'restore routes',
        ]);
    }
}
