<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Database\Seeders\Traits\TruncateTable;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuItemSeeder extends Seeder
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
        $this->truncate('menu_items');

        $menuItems = [
            [
                "menu_id" => 1,
                'title' => ['en' => 'About us', 'ru' => 'О нас', 'uk' => 'Про нас', 'pl' => 'O nas'],
                'slug' => str::slug("Про нас"),
            ],
            [
                "menu_id" => 1,
                'title' => ['en' => "Our documents", 'ru' => 'Наши документы',
                    'uk' => 'Наші документи', 'pl' => 'Nasze dokumenty'],
                'slug' => str::slug("Наші документи"),
            ],
            [
                "menu_id" => 1,
                'title' => ['en' => 'Guides', 'ru' => 'экскурсоводы', 'uk' => 'Екскурсоводи', 'pl' => 'Przewodniki'],
                'slug' => str::slug("Екскурсоводи"),
            ],
            [
                "menu_id" => 1,
                'title' => ['en' => 'Office workers', 'ru' => 'Офисные работники',
                    'uk' => 'Офісні працівники', 'pl' => 'Pracownicy biurowi'],
                'slug' => str::slug("Офісні працівники"),
            ],
            [
                "menu_id" => 1,
                'title' => ['en' => 'News', 'ru' => 'Новости', 'uk' => 'Новини', 'pl' => 'Aktualności'],
                'slug' => str::slug("Новини"),
            ],
            [
                "menu_id" => 1,
                'title' => ['en' => 'Charity', 'ru' => 'Благотворительность', 'uk' => 'Благодійність', 'pl' => 'Dobroczynność'],
                'slug' => str::slug("Благодійність"),
            ],

            [
                "menu_id" => 1,
                'title' => ['en' => 'Awards and honors', 'ru' => 'Награды и отличия',
                    'uk' => 'Нагороди та відзнаки', 'pl' => 'Nagrody i wyróżnienia'],
                'slug' => str::slug("Нагороди та відзнаки"),
            ],
            [
                "menu_id" => 1,
                'title' => ['en' => 'Vacancies', 'ru' => 'вакансии', 'uk' => 'Вакансії', 'pl' => 'Wakaty'],
                'slug' => str::slug("Вакансії"),
            ],
            [
                "menu_id" => 1,
                'title' => ['en' => 'Reviews', 'ru' => 'Отзывы', 'uk' => 'Практика', 'pl' => ''],
                'slug' => str::slug("Практика"),
            ],
            [
                "menu_id" => 1,
                'title' => ['en' => '', 'ru' => '', 'uk' => 'Відгуки', 'pl' => 'Recenzje'],
                'slug' => str::slug("Відгуки"),
            ],
            [
                "menu_id" => 1,
                'title' => ['en' => 'Blog', 'ru' => 'Блог', 'uk' => 'Блог', 'pl' => 'Blog'],
                'slug' => str::slug("Блог"),
            ],

            [
                "menu_id" => 2,
                'title' => ['en' => 'Popular tours', 'ru' => 'Популярные места',
                    'uk' => 'Популярні тури', 'pl' => 'Popularne wycieczki'],
                'slug' => str::slug("Популярні тури"),
            ],

            [
                "menu_id" => 2,
                'title' => ['en' => 'Tours of Synevir', 'ru' => 'Туры на Синевир',
                    'uk' => 'Тури на Синевир', 'pl' => 'Wycieczki po Synewyrze'],
                'slug' => str::slug("Тури на Синевир"),
            ],
            [
                "menu_id" => 2,
                'title' => ['en' => "New Year's tours", 'ru' => 'Туры на Новый Год',
                    'uk' => 'Тури на Новий Рік', 'pl' => 'Wycieczki noworoczne'],
                'slug' => str::slug("Тури на Новий Рік"),
            ],
            [
                "menu_id" => 2,
                'title' => ['en' => 'Christmas tours', 'ru' => 'Туры на Рождество',
                    'uk' => 'Тури на Різдво', 'pl' => 'Świąteczne wycieczki'],
                'slug' => str::slug("Тури на Різдво"),
            ],
            [
                "menu_id" => 2,
                'title' => ['en' => 'Tours in the Carpathians', 'ru' => 'Туры в Карпаты',
                    'uk' => 'Тури в Карпати', 'pl' => 'Wycieczki po Karpatach'],
                'slug' => str::slug("Тури в Карпати"),
            ],
            [
                "menu_id" => 2,
                'title' => ['en' => 'On cheese to Rakhiv', 'ru' => 'На брынзу в Рахов',
                    'uk' => 'На бринзу до Рахова', 'pl' => 'O serze do Rachowa'],
                'slug' => str::slug("На бринзу до Рахова"),
            ],


            [
                "menu_id" => 5,
                'title' => ['en' => 'Travel agents', 'ru' => 'турагентам', 'uk' => 'Турагентам', 'pl' => ''],
                'slug' => str::slug("Турагентам"),
            ],

            [
                "menu_id" => 5,
                'title' => ['en' => 'Schools', 'ru' => 'школам', 'uk' => 'Школам', 'pl' => 'Szkoły'],
                'slug' => str::slug("Школам"),
            ],
            [
                "menu_id" => 5,
                'title' => ['en' => 'Corporate parties', 'ru' => 'корпоративы', 'uk' => 'Корпоративи',
                    'pl' => 'Imprezy firmowe'],
                'slug' => str::slug("Корпоративи"),
            ],
            [
                "menu_id" => 5,
                'title' => ['en' => 'Gift certificate', 'ru' => 'Подарочный сертификат',
                    'uk' => 'Подарунковий сертифікат', 'pl' => 'Bon upominkowy'],
                'slug' => str::slug("Подарунковий сертифікат"),
            ],
            [
                "menu_id" => 5,
                'title' => ['en' => 'Transport', 'ru' => 'транспорт', 'uk' => 'Транспорт', 'pl' => 'Transport'],
                'slug' => str::slug("Транспорт"),
            ],
            [
                "menu_id" => 5,
                'title' => ['en' => "Guides' courses", 'ru' => 'Курсы экскурсоводов',
                    'uk' => 'Курси екскурсоводів', 'pl' => 'Kursy przewodników'],
                'slug' => str::slug("Курси екскурсоводів"),
            ],
            [
                "menu_id" => 5,
                'title' => ['en' => 'Accommodation', 'ru' => 'Проживанняs', 'uk' => 'Проживанняs', 'pl' => 'Zakwaterowanie'],
                'slug' => str::slug("Проживанняs"),
            ],

        ];

        foreach ($menuItems as $menuItem) {
            MenuItem::factory()->create($menuItem);
        }

        $this->enableForeignKeys();
    }
}
