<?php

namespace Database\Seeders;

use App\Models\SmsNotification;
use Illuminate\Database\Seeder;

class SmsNotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SmsNotification::query()->truncate();

        $data = [
            [
                'key' => 'order',
                'title' => 'Нове замовлення',
                'text' => 'Нове замовлення',
                'phone' => true,
                'viber' => true,
            ],
            [
                'key' => 'register-tour-agent',
                'title' => 'Реєстрація нового турагента',
                'text' => 'Реєстрація нового турагента',
                'phone' => true,
                'viber' => true,
            ],
            [
                'key' => 'order-one-click',
                'title' => 'Замовити в 1 клік',
                'text' => 'Замовити в 1 клік',
                'phone' => true,
                'viber' => true,
            ],
            [
                'key' => 'staff-testimonial',
                'title' => 'Відгук про менеджера / турагента',
                'text' => 'Відгук про менеджера / турагента',
                'phone' => true,
                'viber' => true,
            ],
            [
                'key' => 'corporate',
                'title' => 'Запит про корпоратив',
                'text' => 'Запит про корпоратив',
                'phone' => true,
                'viber' => true,
            ],
            [
                'key' => 'certificate',
                'title' => 'Замовлення сертифікату',
                'text' => 'Замовлення сертифікату',
                'phone' => true,
                'viber' => true,
            ],
        ];

        foreach ($data as $item) {
            SmsNotification::query()->firstOrCreate(['key' => $item['key']], $item);
        }
    }
}
