<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\TourGroup;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
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
        $this->truncateMultiple(['menus', 'menu_items']);

        $menus = [
            [
                'id' => 1,
                'title' => ['en' => 'Header', 'ru' => 'Шапка', 'uk' => 'Шапка', 'pl' => 'Header'],
                'slug' => 'header',
            ],
            [
                'id' => 2,
                'title' => ['en' => 'Footer', 'ru' => 'Подвал', 'uk' => 'Підвал', 'pl' => 'Footer'],
                'slug' => 'footer',
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }

        $tourGroups = TourGroup::published()->get()->map(function ($item) {
            return [
                'title' => $item->getTranslations('title'),
                'slug' => $item->getTranslations('slug'),
                'side' => 'left',
            ];
        });

        $header_menu_items = [
            [
                'title' => ['uk' => 'Чому відвідай', 'ru' => 'Почему відвідай', 'en' => 'Why vidviday', 'pl' => 'Why vidviday'],
                'slug' => pageUrlByKey('about'),
                'children' => [
                    [
                        'title' => ['uk' => 'Про нас'],
                        'slug' => pageUrlByKey('about'),
                        'side' => 'left',
                    ],
                    [
                        'title' => ['uk' => 'Наші документи'],
                        'slug' => pageUrlByKey('documents'),
                        'side' => 'left',
                    ],
                    [
                        'title' => ['uk' => 'Екскурсоводи'],
                        'slug' => pageUrlByKey('guides'),
                        'side' => 'left',
                    ],
                    [
                        'title' => ['uk' => 'Офісні працівники'],
                        'slug' => pageUrlByKey('office-workers'),
                        'side' => 'left',
                    ],
                    [
                        'title' => ['uk' => 'Новини'],
                        'slug' => pageUrlByKey('news'),
                        'side' => 'left',
                    ],
                    [
                        'title' => ['uk' => 'Благодійність'],
                        'slug' => pageUrlByKey('charity'),
                        'side' => 'left',
                    ],

                    [
                        'title' => ['uk' => 'Нагороди та відзнаки'],
                        'slug' => pageUrlByKey('awards-and-honors'),
                        'side' => 'right',
                    ],
                    [
                        'title' => ['uk' => 'Вакансії'],
                        'slug' => pageUrlByKey('vacancies'),
                        'side' => 'right',
                    ],
                    [
                        'title' => ['uk' => 'Практика'],
                        'slug' => pageUrlByKey('practice'),
                        'side' => 'right',
                    ],
                    [
                        'title' => ['uk' => 'Відгуки'],
                        'slug' => pageUrlByKey('testimonials'),
                        'side' => 'right',
                    ],
                    [
                        'title' => ['uk' => 'Блог'],
                        'slug' => pageUrlByKey('blog'),
                        'side' => 'right',
                    ],
                ],
            ],
            [
                'title' => ['uk' => 'Тури', 'ru' => 'Туры', 'en' => 'Tours', 'pl' => 'Tours'],
                'slug' => pageUrlByKey('tours'),
                'children' => $tourGroups,
            ],
            [
                'title' => ['uk' => 'Замовити тур', 'ru' => 'Заказать тур', 'en' => 'Book a tour', 'pl' => 'Book a tour'],
                'slug' => pageUrlByKey('order'),
                'class_name' => 'only-pad-mobile',
                'children' => [],
            ],
            [
                'title' => ['uk' => 'Місця', 'ru' => 'Места', 'en' => 'Places', 'pl' => 'Places'],
                'slug' => pageUrlByKey('places'),
                'children' => [],
            ],
            [
                'title' => ['uk' => 'Події', 'ru' => 'События', 'en' => 'Events', 'pl' => 'Events'],
                'slug' => pageUrlByKey('events'),
                'children' => [],
            ],
            [
                'title' => ['uk' => 'Пропозиції', 'ru' => 'Предложения', 'en' => 'Suggestions', 'pl' => 'Propozycje'],
                'slug' => '#',
                'children' => [
                    [
                        'title' => ['uk' => 'Турагентам'],
                        'slug' => pageUrlByKey('for-travel-agents'),
                        'side' => 'left',
                    ],
                    [
                        'title' => ['uk' => 'Школам'],
                        'slug' => pageUrlByKey('schools'),
                        'side' => 'left',
                    ],
                    [
                        'title' => ['uk' => 'Корпоративи'],
                        'slug' => pageUrlByKey('corporates'),
                        'side' => 'left',
                    ],
                    [
                        'title' => ['uk' => 'Подарунковий сертифікат'],
                        'slug' => pageUrlByKey('certificate'),
                        'side' => 'left',
                    ],
                    [
                        'title' => ['uk' => 'Транспорт'],
                        'slug' => pageUrlByKey('transport'),
                        'side' => 'left',
                    ],
                    [
                        'title' => ['uk' => 'Курси екскурсоводів'],
                        'slug' => pageUrlByKey('guides-courses'),
                        'side' => 'left',
                    ],
                    [
                        'title' => ['uk' => 'Проживання'],
                        'slug' => pageUrlByKey('accommodation'),
                        'side' => 'left',
                    ],
                ],
            ],
            [
                'title' => ['uk' => 'Є питання?', 'ru' => 'Есть вопросы?', 'en' => 'Have a question?', 'pl' => 'Mam pytanie?'],
                'slug' => pageUrlByKey('faq'),
                'children' => [],
            ],
            [
                'title' => ['uk' => 'Контакти', 'ru' => 'Контакты', 'en' => 'Contacts', 'pl' => 'Łączność'],
                'slug' => pageUrlByKey('contacts'),
                'children' => [],
            ],
        ];

        $footer_menu_items = [
            [
                'title' => ['uk' => 'Тури', 'ru' => 'Туры', 'en' => 'Tours', 'pl' => 'Tours'],
                'slug' => pageUrlByKey('tours'),
                'children' => $tourGroups,
            ],
            [
                'title' => ['uk' => 'Пропозиції', 'ru' => 'Предложения', 'en' => 'Suggestions', 'pl' => 'Propozycje'],
                'slug' => '#',
                'children' => [
                    [
                        'title' => ['uk' => 'Турагентам'],
                        'slug' => pageUrlByKey('for-travel-agents'),
                        'side' => 'left',
                    ],
                    [
                        'title' => ['uk' => 'Школам'],
                        'slug' => pageUrlByKey('schools'),
                        'side' => 'left',
                    ],
                    [
                        'title' => ['uk' => 'Корпоративи'],
                        'slug' => pageUrlByKey('corporates'),
                        'side' => 'left',
                    ],
                    [
                        'title' => ['uk' => 'Транспорт'],
                        'slug' => pageUrlByKey('transport'),
                        'side' => 'left',
                    ],
                    [
                        'title' => ['uk' => 'Відгуки'],
                        'slug' => pageUrlByKey('testimonials'),
                        'side' => 'left',
                    ],
                ],
            ],
        ];

        foreach ($header_menu_items as $position => $menu_item) {
            $data = array_merge($menu_item, ['published' => 1, 'menu_id' => 1, 'parent_id' => 0, 'position' => $position]);
            $children = $data['children'];
            unset($data['children']);
            $menuItem = MenuItem::create($data);
            if (! empty($children)) {
                foreach ($children as $pos => $child) {
                    $data = array_merge($child, ['published' => 1, 'menu_id' => 1, 'parent_id' => $menuItem->id, 'position' => $pos]);
                    $menuChildren = MenuItem::create($data);
                }
            }
        }

        foreach ($footer_menu_items as $position => $menu_item) {
            $data = array_merge($menu_item, ['published' => 1, 'menu_id' => 2, 'parent_id' => 0, 'position' => $position]);
            $children = $data['children'];
            unset($data['children']);
            $menuItem = MenuItem::create($data);
            if (! empty($children)) {
                foreach ($children as $pos => $child) {
                    $data = array_merge($child, ['published' => 1, 'menu_id' => 2, 'parent_id' => $menuItem->id, 'position' => $pos]);
                    $menuChildren = MenuItem::create($data);
                }
            }
        }

        $this->enableForeignKeys();
    }
}
