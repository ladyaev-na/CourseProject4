<?php

namespace Database\Seeders;

use App\Models\Bonus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BonusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bonus::create([
            'title' => 'Приведи друга',
            'description' => 'При пополнение нашей команды ты получаешь бонус.',
            'price' => '15000',
            'role_id' => 1
        ]);
        Bonus::create([
            'title' => 'Доплата за плохую погоду',
            'description' => 'Условия: Компания-партнёр доплатит до 15% от базовой ставки за доставленные заказы в периоды сложных погодных условий. Доплата начисляется к заказам, если осадки идут 4 часа и более.',
            'price' => '10',
            'role_id' => 2
        ]);
        Bonus::create([
            'title' => 'Добрый вечер',
            'description' => 'Условия: Доставляй заказы в вечерние часы с 18:00 до 23:00 в период с 1 ноября по 31 декабря. Сроки: С 01 ноября 2024 по 01 января 2025.',
            'price' => '5',
            'role_id' => 2
        ]);
        Bonus::create([
            'title' => 'Счастливые заказы',
            'description' => 'Условия: Доставляй заказы с 07:00 до 09:00 и с 23:00 до 01:00 в период с 7 октября по 31 декабря и получай надбавку к доставленным заказам. Сроки: С 07 октября 2024 по 01 января 2025.',
            'price' => '50',
            'role_id' => 2
        ]);
        Bonus::create([
            'title' => 'Доплата за ёлки',
            'description' => 'Условия: Доставляй ёлки с 10 по 31 декабря и получай надбавку за каждую доставленную ёлку. Сроки: С 10 декабря 2024 по 01 января 2025.',
            'price' => '100',
            'role_id' => 1
        ]);
    }
}
