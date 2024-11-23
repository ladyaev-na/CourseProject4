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
            'description' => 'При пополнение нашей команды ты получаешь бонус',
            'price' => '5000',
        ]);
        Bonus::create([
            'title' => 'Плохая погода',
            'description' => 'При плохой погоде ты будешь получать надбавку за заказ',
            'price' => '10',
        ]);
        Bonus::create([
            'title' => 'Добрый вечер',
            'description' => 'Выходи на доставку с 18 до 23 вечера и получай надбавку за заказ',
            'price' => '5',
        ]);
    }
}
