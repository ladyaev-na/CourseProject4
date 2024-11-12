<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'surname' => 'Рюгин',
            'name' => 'Алексей',
            'patronymic' => 'Иванович',
            'login' => 'Alex',
            'password' => 'QWEqwe123@',
            'api_token' => null,
            'role_id' => 1,
        ]);

        User::create([
            'surname' => 'Ладяев',
            'name' => 'Никита',
            'patronymic' => 'Александрович',
            'login' => 'Nikita',
            'password' => 'ASDasd123@',
            'api_token' => null,
            'role_id' => 2,
        ]);
    }
}
