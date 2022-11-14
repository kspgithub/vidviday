<?php

namespace Database\Seeders;

use App\Models\Contact;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->truncate('contacts');

        $contacts = [
            [
                'title' => ['en' => 'Contacts', 'ru' => 'Контакты', 'uk' => 'Контакти', 'pl' => 'Kontakty'],
                'address' => [
                    'en' => 'Lviv, street Zamarstynivska, 34',
                    'ru' => 'Львов, ул. Замарстиновськая, 34',
                    'uk' => 'Львів, вул. Замарстинівська, 34',
                    'pl' => 'Lwów, ulica Zamarstyniwska, 34',
                ],
                'address_comment' => [
                    'en' => '* located on the corner of st. Tatar',
                    'ru' => '* расположен на углу с ул. татарском',
                    'uk' => '*розташований на розі із вул. Татарською',
                    'pl' => '* znajduje się na rogu ul. Tatar',
                ],
                'opening_hours' => [
                    'en' => 'mon. - fri. - 9:00 am - 20:00 pm sat. - sun. - closed',
                    'ru' => 'пн. - пт. - 9:00 - 20:00 сб. - нд. - выходной',
                    'uk' => 'пн. - пт. - 9:00 - 20:00 сб. - нд. - вихідний',
                    'pl' => 'pon - ptk. - 9:00 - 20:00 sob. - ndz. - dzień wolny',
                ],
                'work_phone' => '+38 (032) 255 36 55',
                'phone_1' => '+38 (096) 481 36 70',
                'phone_2' => '+38 (063) 366 78 64',
                'phone_3' => '+38 (066) 825 99 36',
                'lat' => '49.850562',
                'lng' => '24.026892',
                'email' => 'vidviday.com.ua@gmail.com',
                'skype' => 'skype',
                'viber' => 'viber',
                'telegram' => 'telegram',
                'whatsapp' => 'whatsapp',
                'messenger' => 'messenger',
            ],
        ];

        foreach ($contacts as $contact) {
            Contact::create($contact);
        }
    }
}
