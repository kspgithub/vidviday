<?php

namespace Database\Seeders;

use App\Models\QuestionType;
use App\Models\UserQuestion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class QuestionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locales = array_keys(config('site-settings.locale.languages'));

        $data = [
            [
                'id' => 1,
                'type' => UserQuestion::TYPE_CALL,
                'title' => array_combine($locales, array_map(fn($locale) => 'Запитання що до туру', $locales)),
                'published' => 1,
            ],
            [
                'id' => 2,
                'type' => UserQuestion::TYPE_CALL,
                'title' => array_combine($locales, array_map(fn($locale) => 'Запитання що до сертифікату', $locales)),
                'published' => 1,
            ],
            [
                'id' => 3,
                'type' => UserQuestion::TYPE_CALL,
                'title' => array_combine($locales, array_map(fn($locale) => 'Інше', $locales)),
                'published' => 1,
            ],
            [
                'id' => 4,
                'type' => UserQuestion::TYPE_EMAIL,
                'title' => array_combine($locales, array_map(fn($locale) => 'Запитання що до туру', $locales)),
                'published' => 1,
            ],
            [
                'id' => 5,
                'type' => UserQuestion::TYPE_EMAIL,
                'title' => array_combine($locales, array_map(fn($locale) => 'Запитання що до сертифікату', $locales)),
                'published' => 1,
            ],
            [
                'id' => 6,
                'type' => UserQuestion::TYPE_EMAIL,
                'title' => array_combine($locales, array_map(fn($locale) => 'Інше', $locales)),
                'published' => 1,
            ],

            [
                'id' => 7,
                'type' => UserQuestion::TYPE_CANCEL,
                'title' => array_combine($locales, array_map(fn($locale) => 'Перенесення на іншу дату або інший тур', $locales)),
                'published' => 1,
            ],
            [
                'id' => 8,
                'type' => UserQuestion::TYPE_CANCEL,
                'title' => array_combine($locales, array_map(fn($locale) => 'Несприятлива погода', $locales)),
                'published' => 1,
            ],
            [
                'id' => 9,
                'type' => UserQuestion::TYPE_CANCEL,
                'title' => array_combine($locales, array_map(fn($locale) => "Погіршення стану здоров'я", $locales)),
                'published' => 1,
            ],
            [
                'id' => 10,
                'type' => UserQuestion::TYPE_CANCEL,
                'title' => array_combine($locales, array_map(fn($locale) => 'Непередбачувані особисті обставини', $locales)),
                'published' => 1,
            ],

            [
                'id' => 11,
                'type' => UserQuestion::TYPE_CANCEL,
                'title' => array_combine($locales, array_map(fn($locale) => 'Не влаштували умови замовлення', $locales)),
                'published' => 1,
            ],

            [
                'id' => 12,
                'type' => UserQuestion::TYPE_CANCEL,
                'title' => array_combine($locales, array_map(fn($locale) => 'Ваш варіант (із можливістю заповнення)', $locales)),
                'published' => 1,
            ],

        ];

        foreach ($data as $item) {
            QuestionType::query()->updateOrCreate(Arr::only($item, ['id']), $item);
        }
    }
}
