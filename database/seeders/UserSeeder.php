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
            'status_id' => 1,
        ]);

        User::create([
            'surname' => 'Ладяев',
            'name' => 'Никита',
            'patronymic' => 'Александрович',
            'login' => 'Nikita',
            'password' => 'ASDasd123@',
            'api_token' => null,
            'role_id' => 2,
            'fine_id' => 1,
            'status_id' => 1,
        ]);

        User::create([
            'surname' => 'Евсеев',
            'name' => 'Дмитрий',
            'patronymic' => 'Витальевич',
            'login' => 'Evseev',
            'password' => 'QWEqwe123@',
            'api_token' => null,
            'role_id' => 2,
            'fine_id' => 1,
            'status_id' => 1,
        ]);

        User::create([
            'surname' => 'Бондаренко',
            'name' => 'Кирилл',
            'patronymic' => 'Владимирович',
            'login' => 'Bonbon',
            'password' => 'QWEqwe123@',
            'api_token' => null,
            'role_id' => 2,
            'fine_id' => 1,
            'status_id' => 1,
        ]);

        User::create([
            'surname' => 'Ридт',
            'name' => 'Денис',
            'patronymic' => 'Александрович',
            'login' => 'Ridt',
            'password' => 'QWEqwe123@#',
            'api_token' => null,
            'role_id' => 2,
            'fine_id' => 1,
            'status_id' => 1,
        ]);

        User::create([
            'surname' => 'Мотов',
            'name' => 'Алибала',
            'patronymic' => 'Эльманович',
            'login' => 'Motov',
            'password' => 'QWEqwe123@',
            'api_token' => null,
            'role_id' => 2,
            'fine_id' => 1,
            'status_id' => 1,

        ]);

        User::create([
            'surname' => 'Стреколовский',
            'name' => 'Артём',
            'patronymic' => 'Витальевич',
            'login' => 'Strekolovskiy',
            'password' => 'QWEqwe123@',
            'api_token' => null,
            'role_id' => 2,
            'fine_id' => 1,
            'status_id' => 1,
        ]);

        User::create([
            'surname' => 'Федоров',
            'name' => 'Алексей',
            'patronymic' => 'Алексеевич',
            'login' => 'AlexF',
            'password' => 'QWEqwe123@',
            'api_token' => null,
            'role_id' => 2,
            'fine_id' => 1,
            'status_id' => 1,
        ]);

        User::create([
            'surname' => 'Окулов',
            'name' => 'Семён',
            'patronymic' => 'Михайлович',
            'login' => 'Okulov',
            'password' => 'QWEqwe123@',
            'api_token' => null,
            'role_id' => 2,
            'fine_id' => 1,
            'status_id' => 1,
        ]);
        User::create([
            'surname' => 'Заикин',
            'name' => 'Вадим',
            'patronymic' => 'Анатольевич',
            'login' => 'Zaikin',
            'password' => 'QWEqwe123@',
            'api_token' => null,
            'role_id' => 2,
            'fine_id' => 1,
            'status_id' => 1,
        ]);
        User::create([
            'surname' => 'Матохнюк',
            'name' => 'Александр',
            'patronymic' => 'Александрович',
            'login' => 'Matohnyuk',
            'password' => 'QWEqwe123@',
            'api_token' => null,
            'role_id' => 2,
            'fine_id' => 1,
            'status_id' => 1,
        ]);
        User::create([
            'surname' => 'Волков',
            'name' => 'Дмитрий',
            'patronymic' => 'Павлович',
            'login' => 'Volkov',
            'password' => 'QWEqwe123@',
            'api_token' => null,
            'role_id' => 2,
            'fine_id' => 1,
            'status_id' => 1,
        ]);
        User::create([
            'surname' => 'Шейкина',
            'name' => 'Елизавета',
            'patronymic' => 'Викторовна',
            'login' => 'Sheykina',
            'password' => 'QWEqwe123@',
            'api_token' => null,
            'role_id' => 2,
            'fine_id' => 1,
            'status_id' => 1,
        ]);
    }
}
