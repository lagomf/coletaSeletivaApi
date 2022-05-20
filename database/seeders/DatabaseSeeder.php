<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
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
        Artisan::call('passport:install');
        $this->call(CitySeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(SensorProviderSeeder::class);
        
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'mlfrete@gmail.com',
            'password' => 'root'
        ]);
        $role = Role::first();
        $user->assignRole($role);
    }
}
