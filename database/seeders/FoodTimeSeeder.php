<?php

namespace Database\Seeders;

use App\Models\FoodTime;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class FoodTimeSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->disableForeignKeys();
        $this->truncate('food_times');
        $food_times = [
            ['title' => ['uk' => 'Сніданок', 'ru' => 'Завтрак', 'en' => 'Breakfast', 'pl' => 'Śniadanie'], 'slug' => 'breakfast'],
            ['title' => ['uk' => 'Обід', 'ru' => 'Обед', 'en' => 'Lunch', 'pl' => 'Obiad'], 'slug' => 'lunch'],
            ['title' => ['uk' => 'Вечеря', 'ru' => 'Ужин', 'en' => 'Dinner', 'pl' => 'Kolacja'], 'slug' => 'dinner'],
        ];

        foreach ($food_times as $food_time) {
            FoodTime::create($food_time);
        }

        $this->enableForeignKeys();
    }
}
