<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::create([
            'name' => 'Активный',
            'code' => 'active',
        ]);
        Status::create([
            'name' => 'Неактивный',
            'code' => 'inactive',
        ]);
        Status::create([
            'name' => 'Отстранён',
            'code' => 'suspended',
        ]);
    }
}
