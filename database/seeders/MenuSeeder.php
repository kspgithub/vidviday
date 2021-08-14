<?php

namespace Database\Seeders;

use App\Models\Menu;
use Database\Seeders\Traits\TruncateTable;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('menus');

        $menus = [
            [
                'title'=>['en'=>'why visit', 'ru'=>'почему посети', 'uk'=>'Чому відвідай',  'pl'=>'dlaczego goście'],
                'slug'=>'why-visit',
            ],

            [
                'title'=>['en'=>'Tours', 'ru'=>'Туры', 'uk'=>'Тури',  'pl'=>'Wycieczki'],
                'slug'=>'tours',
            ],

            [
                'title'=>['en'=>'Places', 'ru'=>'Места', 'uk'=>'Місця',  'pl'=>'Miejsca'],
                'slug'=>'places',
            ],

            [
                'title'=>['en'=>'Events', 'ru'=>'События', 'uk'=>'Події',  'pl'=>'Wydarzenia'],
                'slug'=>'events',
            ],

            [
                'title'=>['en'=>'Propositions', 'ru'=>'Проедложения', 'uk'=>'Пропозиції ',  'pl'=>'Propozycje'],
                'slug'=>'propositions',
            ],

            [
                'title'=>['en'=>'Contacts', 'ru'=>'Контакты', 'uk'=>'Контакти',  'pl'=>'Kontakty'],
                'slug'=>'contacts',
            ],
            [
                'title'=>['en'=>'Any question?', 'ru'=>'Есть вопрос?', 'uk'=>'Є питання?',  'pl'=>'Masz pytanie?'],
                'slug'=>'any-question',
            ],



        ];

        foreach ($menus as $menu) {
            Menu::factory()->create($menu);
        }

        $this->enableForeignKeys();
    }
}
