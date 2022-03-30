<?php

namespace Database\Seeders;

use App\Models\User;
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
        $this->call(PermissionsSeeder::class);
        
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'mlfrete@gmail.com',
            'password' => 'root'
        ]);

        $user->assignRole('Super Admin');

        
    }
}
