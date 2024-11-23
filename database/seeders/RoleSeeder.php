<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create([
           'name' => 'Администратор',
           'code' => 'admin',
            'bonus_id' => 1
        ]);

        Role::create([
            'name' => 'Курьер',
            'code' => 'сourier',
            'bonus_id' => 1
        ]);

        Role::create([
            'name' => 'Координатор',
            'code' => 'coordinator',
            'bonus_id' => 1
        ]);
    }
}
