<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CitySeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(PermissionsSeeder::class);
        
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'mlfrete@gmail.com',
            'password' => 'root'
        ]);
        $role = Role::first();
        $user->assignRole($role);

        
    }
}
