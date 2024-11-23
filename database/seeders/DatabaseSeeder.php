<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            FineSeeder::class,
            BonusSeeder::class,
            AccessSeeder::class,
            ShiftSeeder::class,
            StatusSeeder::class,
        ]);
    }
}
