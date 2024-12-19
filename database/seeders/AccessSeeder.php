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
            'date' => '2024-12-20',
            'startChange' => '08:00:00',
            'endChange' => '23:00:00',
            'confirm' => false,
            'user_id' => 2
        ]);
        Access::create([
            'date' => '2024-12-20',
            'startChange' => '08:00:00',
            'endChange' => '23:00:00',
            'confirm' => false,
            'user_id' => 2
        ]);
    }
}
