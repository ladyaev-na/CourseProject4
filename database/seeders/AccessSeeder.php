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
            'user_id' => 3
        ]);
        Access::create([
            'date' => '2023-10-03',
            'startChange' => '08:00:00',
            'endChange' => '13:00:00',
            'confirm' => false,
            'user_id' => 4
        ]);
        Access::create([
            'date' => '2023-10-03',
            'startChange' => '14:00:00',
            'endChange' => '18:00:00',
            'confirm' => false,
            'user_id' => 4
        ]);
        Access::create([
            'date' => '2023-10-03',
            'startChange' => '19:00:00',
            'endChange' => '23:00:00',
            'confirm' => false,
            'user_id' => 5
        ]);
        Access::create([
            'date' => '2024-12-15',
            'startChange' => '19:00:00',
            'endChange' => '23:00:00',
            'confirm' => false,
            'user_id' => 5
        ]);
        Access::create([
            'date' => '2024-12-13',
            'startChange' => '19:00:00',
            'endChange' => '23:00:00',
            'confirm' => false,
            'user_id' => 6
        ]);
        Access::create([
            'date' => '2024-12-05',
            'startChange' => '19:00:00',
            'endChange' => '23:00:00',
            'confirm' => false,
            'user_id' => 7
        ]);
        Access::create([
            'date' => '2024-12-05',
            'startChange' => '08:00:00',
            'endChange' => '18:00:00',
            'confirm' => false,
            'user_id' => 10
        ]);
        Access::create([
            'date' => '2024-12-01',
            'startChange' => '19:00:00',
            'endChange' => '23:00:00',
            'confirm' => false,
            'user_id' => 8
        ]);
        Access::create([
            'date' => '2024-12-29',
            'startChange' => '19:00:00',
            'endChange' => '23:00:00',
            'confirm' => false,
            'user_id' => 8
        ]);
        Access::create([
            'date' => '2024-12-30',
            'startChange' => '19:00:00',
            'endChange' => '23:00:00',
            'confirm' => false,
            'user_id' => 10
        ]);
        Access::create([
            'date' => '2025-01-01',
            'startChange' => '19:00:00',
            'endChange' => '23:00:00',
            'confirm' => false,
            'user_id' => 10
        ]);
        Access::create([
            'date' => '2025-01-01',
            'startChange' => '19:00:00',
            'endChange' => '23:00:00',
            'confirm' => false,
            'user_id' => 10
        ]);
    }
}
