<?php

namespace Database\Seeders;

use App\Models\Access;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Access::create([
            'date' => '2023-10-01',
            'startChange' => '08:00:00',
            'endChange' => '23:00:00',
            'confirm' => false,
            'user_id' => 2
        ]);
        Access::create([
            'date' => '2023-10-02',
            'startChange' => '08:00:00',
            'endChange' => '17:00:00',
            'confirm' => false,
            'user_id' => 2
        ]);
        Access::create([
            'date' => '2023-10-02',
            'startChange' => '18:00:00',
            'endChange' => '23:00:00',
            'confirm' => false,
            'user_id' => 2
        ]);
        Access::create([
            'date' => '2023-10-03',
            'startChange' => '08:00:00',
            'endChange' => '13:00:00',
            'confirm' => false,
            'user_id' => 2
        ]);
        Access::create([
            'date' => '2023-10-03',
            'startChange' => '14:00:00',
            'endChange' => '18:00:00',
            'confirm' => false,
            'user_id' => 2
        ]);
        Access::create([
            'date' => '2023-10-03',
            'startChange' => '19:00:00',
            'endChange' => '23:00:00',
            'confirm' => false,
            'user_id' => 2
        ]);
    }
}
