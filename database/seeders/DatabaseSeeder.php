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
            FineSeeder::class,
            StatusSeeder::class,
            RoleSeeder::class,
            BonusSeeder::class,
            UserSeeder::class,
            AccessSeeder::class,
            ShiftSeeder::class,
        ]);
    }
}
