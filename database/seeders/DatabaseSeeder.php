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
            AccessSeeder::class,
            ShiftSeeder::class,
            StatusSeeder::class,
            BonusSeeder::class,
            RoleSeeder::class,
            FineSeeder::class,
            UserSeeder::class,
        ]);
    }
}
