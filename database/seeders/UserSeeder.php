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
            'fine_id' => 1,
        ]);

        /*User::create([
            'surname' => 'Ладяев',
            'name' => 'Никита',
            'patronymic' => 'Александрович',
            'login' => 'Nikita',
            'password' => 'ASDasd123@',
            'api_token' => null,
            'role_id' => 2,
        ]);

        User::create([
            'surname' => 'Иванов',
            'name' => 'Иван',
            'patronymic' => 'Иванович',
            'login' => 'Ivanov',
            'password' => 'Qwerty123!',
            'api_token' => null,
            'role_id' => 3,
        ]);

        User::create([
            'surname' => 'Петров',
            'name' => 'Петр',
            'patronymic' => 'Петрович',
            'login' => 'Petrov',
            'password' => 'PetrP@ssw0rd',
            'api_token' => null,
            'role_id' => 3,
        ]);

        User::create([
            'surname' => 'Сидорова',
            'name' => 'Анна',
            'patronymic' => 'Александровна',
            'login' => 'AnnaS',
            'password' => 'AnnaS123#',
            'api_token' => null,
            'role_id' => 3,
        ]);

        User::create([
            'surname' => 'Кузнецов',
            'name' => 'Дмитрий',
            'patronymic' => 'Дмитриевич',
            'login' => 'DmitryK',
            'password' => 'DmitryK@123',
            'api_token' => null,
            'role_id' => 3,

        ]);

        User::create([
            'surname' => 'Смирнова',
            'name' => 'Елена',
            'patronymic' => 'Ивановна',
            'login' => 'ElenaS',
            'password' => 'ElenaS!23',
            'api_token' => null,
            'role_id' => 3,
        ]);

        User::create([
            'surname' => 'Федоров',
            'name' => 'Алексей',
            'patronymic' => 'Алексеевич',
            'login' => 'AlexF',
            'password' => 'AlexF#123',
            'api_token' => null,
            'role_id' => 3,
        ]);

        User::create([
            'surname' => 'Николаева',
            'name' => 'Ольга',
            'patronymic' => 'Николаевна',
            'login' => 'OlgaN',
            'password' => 'OlgaN@123',
            'api_token' => null,
            'role_id' => 3,
        ]);*/
    }
}
