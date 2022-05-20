<?php

namespace Database\Seeders;

use App\Models\SensorProvider;
use Illuminate\Database\Seeder;

class SensorProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SensorProvider::create([
            'name' => 'UTFPR',
            'identifier' => 'toledo@utfpr'
        ]);
    }
}
