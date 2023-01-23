<?php

namespace Database\Seeders;

use App\Enums\PopupTypes;
use App\Models\PopupMessage;
use Illuminate\Database\Seeder;

class PopupMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'type' => PopupTypes::ONE_CLICK,
                'title' => 'Замовити в 1 клік',
                'description' => '',
            ],
            [
                'type' => PopupTypes::ORDER_CALLBACK,
                'title' => 'Замовити дзвінок',
                'description' => '',
            ],
            [
                'type' => PopupTypes::WRITE_EMAIL,
                'title' => 'Написати листа',
                'description' => '',
            ],
            [
                'type' => PopupTypes::NEWSLETTER,
                'title' => 'Розсилка',
                'description' => '',
            ],
            [
                'type' => PopupTypes::TESTIMONIAL,
                'title' => 'Додати відгук',
                'description' => '',
            ],
            [
                'type' => PopupTypes::QUESTION,
                'title' => 'Поставити питання',
                'description' => '',
            ],
        ];

        foreach ($data as $item) {
            PopupMessage::query()->firstOrCreate(['type' => $item['type']], $item);
        }
    }
}
