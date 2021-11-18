<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Staff;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
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
        //$this->truncate('pages');

        $pages = [
            [
                'title' => ['en' => 'About Us', 'ru' => 'О нас', 'uk' => 'Про нас', 'pl' => 'O nas'],
                'seo_h1' => ['en' => 'About Us', 'ru' => 'О нас', 'uk' => 'Про нас', 'pl' => 'O nas'],
                'key' => 'about',
                'published' => 1,
                'sidebar' => 1,
                'sidebar_items' => ['share', 'contacts', 'testimonials'],
                'staff_id' => Staff::whereHas('types', fn($q) => $q->where('slug', 'booking-manager'))->first()->id ?? 2,
            ],
            [
                'title' => ['en' => 'Our Documents', 'ru' => 'Наши Документы',
                    'uk' => 'Наші документи', 'pl' => 'Nasze dokumenty'],
                'seo_h1' => ['en' => 'Our Documents', 'ru' => 'Наши Документы',
                    'uk' => 'Наші документи', 'pl' => 'Nasze dokumenty'],
                'key' => 'our-documents',
                'published' => 1,
            ],
            [
                'title' => ['en' => 'Guides', 'ru' => 'Экскурсоводы', 'uk' => 'Екскурсоводи', 'pl' => 'Przewodniki'],
                'seo_h1' => ['en' => 'Guides', 'ru' => 'Экскурсоводы', 'uk' => 'Екскурсоводи', 'pl' => 'Przewodniki'],
                'key' => 'guides',
                'published' => 1,
            ],
            [
                'title' => ['en' => 'Office workers', 'ru' => 'Офисные работники',
                    'uk' => 'Офісні працівники', 'pl' => 'Pracownicy biurowi'],
                'seo_h1' => ['en' => 'Office workers', 'ru' => 'Офисные работники',
                    'uk' => 'Офісні працівники', 'pl' => 'Pracownicy biurowi'],
                'key' => 'office-workers',
                'published' => 1,
            ],
            [
                'title' => ['en' => 'News', 'ru' => 'Новости', 'uk' => 'Новини', 'pl' => 'Aktualności'],
                'seo_h1' => ['en' => 'News', 'ru' => 'Новости', 'uk' => 'Новини', 'pl' => 'Aktualności'],
                'key' => 'news',
                'published' => 1,
            ],
            [
                'title' => [
                    'en' => 'Charity',
                    'ru' => 'Благотворительность',
                    'uk' => 'Благодійність',
                    'pl' => 'Dobroczynność'
                ],
                'seo_h1' => [
                    'en' => 'Charity',
                    'ru' => 'Благотворительность',
                    'uk' => 'Благодійність',
                    'pl' => 'Dobroczynność'
                ],
                'key' => 'charity',
                'published' => 1,
            ],
            [
                'title' => ['en' => 'Awards and honors', 'ru' => 'Награды и отличия',
                    'uk' => 'Нагороди та відзнаки', 'pl' => 'Nagrody i wyróżnienia'],
                'seo_h1' => ['en' => 'Awards and honors', 'ru' => 'Награды и отличия',
                    'uk' => 'Нагороди та відзнаки', 'pl' => 'Nagrody i wyróżnienia'],
                'key' => 'awards-and-honors',
                'published' => 1,
            ],
            [
                'title' => ['en' => 'Vacancies', 'ru' => 'Bакансии', 'uk' => 'Вакансії', 'pl' => 'Wakaty'],
                'seo_h1' => ['en' => 'Vacancies', 'ru' => 'Bакансии', 'uk' => 'Вакансії', 'pl' => 'Wakaty'],
                'text' => [
                    'uk' => 'Ми робимо файні тури Україною. Нас об\'єднує бажання відкривати принади нашої країни для всіх, хто хоче її пізнати. Ми постійно ставимо перед собою нові цілі та запрошуємо досягати їх разом з нами!',
                ],
                'video' => 'https://www.youtube.com/embed/BMQQQynlrn4',
                'key' => 'vacancies',
                'images' => [url('/img/banner-img_14.jpg')],
                'published' => 1,
                'sidebar' => 1,
                'sidebar_items' => ['share', 'contacts'],
                'staff_id' => Staff::whereHas('types', fn($q) => $q->where('slug', 'booking-manager'))->first()->id ?? 2,
            ],
            [
                'title' => ['en' => 'Practice', 'ru' => 'Практика', 'uk' => 'Практика', 'pl' => 'Ćwiczyć'],
                'seo_h1' => ['en' => 'Practice', 'ru' => 'Практика', 'uk' => 'Практика', 'pl' => 'Ćwiczyć'],
                'key' => 'practice',
                'published' => 1,
            ],
            [
                'title' => ['en' => 'Blog', 'ru' => 'Блог', 'uk' => 'Блог', 'pl' => 'Blog'],
                'seo_h1' => ['en' => 'Blog', 'ru' => 'Блог', 'uk' => 'Блог', 'pl' => 'Blog'],
                'key' => 'blog',
                'published' => 1,
            ],
            [
                'title' => ['en' => 'Corporates', 'ru' => 'Корпоративы', 'uk' => 'Корпоративи', 'pl' => 'Korporatyvy'],
                'seo_h1' => ['en' => 'Corporates', 'ru' => 'Корпоративы', 'uk' => 'Корпоративи', 'pl' => 'Korporatyvy'],
                'key' => 'corporates',
                'published' => 1,
                'sidebar' => 1,
                'sidebar_items' => ['share', 'contacts', 'testimonials'],
                'staff_id' => Staff::whereHas('types', fn($q) => $q->where('slug', 'corporate-order'))->first()->id ?? 2,
            ],
            [
                'title' => ['en' => 'Places', 'ru' => 'Места', 'uk' => 'Місця', 'pl' => 'Miejsca'],
                'seo_h1' => ['en' => 'Places', 'ru' => 'Места', 'uk' => 'Місця', 'pl' => 'Miejsca'],
                'key' => 'places',
                'published' => 1,
            ],
            [
                'title' => ['en' => 'Contacts', 'ru' => 'Контакты', 'uk' => 'Контакти', 'pl' => 'Kontacty'],
                'seo_h1' => ['en' => 'Contacts', 'ru' => 'Контакты', 'uk' => 'Контакти', 'pl' => 'Kontacty'],
                'key' => 'our-contacts',
                'published' => 1,
            ],
            [
                'title' => [
                    'uk' => 'Є питання?',
                    'ru' => 'Есть вопросы?',
                    'en' => 'Have a question?',
                    'pl' => 'Mam pytanie?'
                ],
                'seo_h1' => [
                    'uk' => '20 основних питань і відповідей щодо успішної співпраці ТО «Відвідай» з партнерами (турагентами)',
                    'ru' => '20 основных вопросов и ответов по успешного сотрудничества ТО «Відвідай» с партнерами (турагентами)',
                    'en' => '20 main questions and answers about the successful cooperation of TO "Vidviday" with partners (travel agents)',
                    'pl' => '20 głównych pytań i odpowiedzi na temat udanej współpracy TO „Vidviday” z partnerami (biurami podróży)'
                ],
                'text' => [
                    'uk' => 'Якщо Вам сподобалися наші тури, то Ви із задоволенням можете продавати їх Вашим туристам. Співпраця з нами дуже проста. Нижче наводимо відповіді на найпопулярніші питання.',
                    'ru' => 'Если Вам понравились наши туры, то Вы с удовольствием можете продавать их Вашим туристам. Сотрудничество с нами очень простая. Ниже приводим ответы на самые популярные вопросы.',
                    'en' => 'If you liked our tours, you can gladly sell them to your tourists. Cooperation with us is very simple. Below are the answers to the most popular questions.',
                    'pl' => 'Jeśli podobały Ci się nasze wycieczki, chętnie sprzedasz je swoim turystom. Współpraca z nami jest bardzo prosta. Poniżej znajdują się odpowiedzi na najpopularniejsze pytania.',
                ],
                'key' => 'faq',
                'published' => 1,
                'sidebar' => 1,
                'sidebar_items' => ['share', 'contacts', 'testimonials'],
                'staff_id' => Staff::whereHas('types', fn($q) => $q->where('slug', 'travel-agencies'))->first()->id ?? 2,
            ],
            [
                'title' => ['en' => 'Testimonials', 'ru' => 'Отзывы', 'uk' => 'Відгуки', 'pl' => 'Referencje'],
                'seo_h1' => ['en' => 'Testimonials', 'ru' => 'Отзывы', 'uk' => 'Відгуки', 'pl' => 'Referencje'],
                'key' => 'testimonials',
                'published' => 1,
            ],
            [
                'title' => [
                    'en' => 'Gift certificate',
                    'ru' => 'Подарочный сертификат',
                    'uk' => 'Подарунковий сертифікат',
                    'pl' => 'Bon upominkowy'
                ],
                'seo_h1' => [
                    'en' => 'Gift certificate',
                    'ru' => 'Подарочный сертификат',
                    'uk' => 'Подарунковий сертифікат',
                    'pl' => 'Bon upominkowy'
                ],
                'text' => [
                    'en' => '<p>A gift certificate is a document that you can buy from us if you need to give a loved one a good trip to Ukraine and make it beautiful.</p>',
                    'ru' => '<p>Подарочный сертификат, это документ, который Вы можете приобрести у нас, если нужно подарить дорогому человеку хорошую путешествие по Украине и красиво это оформить.</p>',
                    'uk' => '<p>Подарунковий сертифікат, це документ, який Ви можете придбати в нас, якщо потрібно подарувати дорогій людині гарну подорож Україною та красиво це оформити.</p>',
                    'pl' => '<p>Bon podarunkowy to dokument, który możesz u nas kupić, jeśli chcesz zapewnić bliskiej osobie udaną podróż na Ukrainę i sprawić, by była piękna.</p>'
                ],
                'key' => 'certificate',
                'published' => 1,
                'sidebar' => 1,
                'sidebar_items' => ['share', 'contacts', 'testimonials'],
                'staff_id' => Staff::whereHas('types', fn($q) => $q->where('slug', 'certificate-manager'))->first()->id ?? 2,
            ],
            [
                'title' => [
                    'uk' => 'Замовлення сертифікату',
                    'en' => 'Order a certificate',
                    'ru' => 'Заказ сертификата',
                    'pl' => 'Zamów certyfikat'
                ],
                'seo_h1' => [
                    'uk' => 'Замовлення сертифікату',
                    'en' => 'Order a certificate',
                    'ru' => 'Заказ сертификата',
                    'pl' => 'Zamów certyfikat'
                ],
                'text' => [
                    'en' => '<p>A gift certificate is a document that you can buy from us if you need to give a loved one a good trip to Ukraine and make it beautiful.</p>',
                    'ru' => '<p>Подарочный сертификат, это документ, который Вы можете приобрести у нас, если нужно подарить дорогому человеку хорошую путешествие по Украине и красиво это оформить.</p>',
                    'uk' => '<p>Подарунковий сертифікат, це документ, який Ви можете придбати в нас, якщо потрібно подарувати дорогій людині гарну подорож Україною та красиво це оформити.</p>',
                    'pl' => '<p>Bon podarunkowy to dokument, który możesz u nas kupić, jeśli chcesz zapewnić bliskiej osobie udaną podróż na Ukrainę i sprawić, by była piękna.</p>'
                ],
                'key' => 'certificate-order',
                'published' => 1,
            ],
            [
                'title' => ['uk' => 'Наші події', 'ru' => 'Наши события', 'en' => 'Our events', 'pl' => 'Nasze wydarzenia'],
                'seo_h1' => ['uk' => 'Наші події', 'ru' => 'Наши события', 'en' => 'Our events', 'pl' => 'Nasze wydarzenia'],
                'key' => 'events',
                'published' => 1,
                'text' => [
                    'en' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate dolorum harum quas sapiente totam! Amet animi aspernatur blanditiis consequuntur deserunt dicta est, exercitationem, natus necessitatibus non repellendus reprehenderit tenetur, vitae!</p>',
                    'ru' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate dolorum harum quas sapiente totam! Amet animi aspernatur blanditiis consequuntur deserunt dicta est, exercitationem, natus necessitatibus non repellendus reprehenderit tenetur, vitae!</p>',
                    'uk' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate dolorum harum quas sapiente totam! Amet animi aspernatur blanditiis consequuntur deserunt dicta est, exercitationem, natus necessitatibus non repellendus reprehenderit tenetur, vitae!</p>',
                    'pl' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate dolorum harum quas sapiente totam! Amet animi aspernatur blanditiis consequuntur deserunt dicta est, exercitationem, natus necessitatibus non repellendus reprehenderit tenetur, vitae!</p>',
                ],
            ],
            [
                'title' => ['uk' => 'Турагентам', 'ru' => 'Турагентам', 'en' => 'For travel agents', 'pl' => 'Dla biur podróży'],
                'seo_h1' => ['uk' => 'Турагентам', 'ru' => 'Турагентам', 'en' => 'For travel agents', 'pl' => 'Dla biur podróży'],
                'key' => 'for-travel-agents',
                'published' => 1,
                'text' => [
                    'en' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate dolorum harum quas sapiente totam! Amet animi aspernatur blanditiis consequuntur deserunt dicta est, exercitationem, natus necessitatibus non repellendus reprehenderit tenetur, vitae!</p>',
                    'ru' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate dolorum harum quas sapiente totam! Amet animi aspernatur blanditiis consequuntur deserunt dicta est, exercitationem, natus necessitatibus non repellendus reprehenderit tenetur, vitae!</p>',
                    'uk' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate dolorum harum quas sapiente totam! Amet animi aspernatur blanditiis consequuntur deserunt dicta est, exercitationem, natus necessitatibus non repellendus reprehenderit tenetur, vitae!</p>',
                    'pl' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate dolorum harum quas sapiente totam! Amet animi aspernatur blanditiis consequuntur deserunt dicta est, exercitationem, natus necessitatibus non repellendus reprehenderit tenetur, vitae!</p>',
                ],
                'sidebar' => 1,
                'sidebar_items' => ['share', 'contacts', 'testimonials'],
                'staff_id' => Staff::whereHas('types', fn($q) => $q->where('slug', 'official'))->first()->id ?? 2,
            ],
            [
                'title' => ['uk' => 'Транспорт'],
                'seo_h1' => ['uk' => 'Оренда автобуса у Львові'],
                'key' => 'transport',
                'published' => 1,
                'text' => [
                    'uk' => '<p></p>',
                ],
                'sidebar' => 1,
                'sidebar_items' => ['share', 'contacts', 'testimonials'],
                'staff_id' => Staff::whereHas('types', fn($q) => $q->where('slug', 'official'))->first()->id ?? 2,
            ],
        ];

        foreach ($pages as $page) {
            $images = $page['images'] ?? [];
            unset($page['images']);

            if (Page::where('key', $page['key'])->count() === 0) {
                $page['slug'] = ['en' => $page['key'], 'uk' => $page['key'], 'ru' => $page['key'], 'pl' => $page['key']];
                $pageModel = Page::factory()->createOne($page);
            } else {
                $page['slug'] = ['en' => $page['key'], 'uk' => $page['key'], 'ru' => $page['key'], 'pl' => $page['key']];
                $pageModel = Page::where('key', $page['key'])->first();
                $pageModel->fill($page);
                $pageModel->save();
            }

            if (!empty($images)) {
                foreach ($images as $image) {
                    $pageModel->addMediaFromUrl($image);
                }
            }
        }


        $this->enableForeignKeys();
    }
}
