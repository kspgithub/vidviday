<?php

namespace Database\Seeders;

use App\Models\Page;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
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
        $this->truncate('pages');

        $pages = [
            [
                'title'=>['en'=>'About Us', 'ru'=>'О нас', 'uk'=>'Про нас',  'pl'=>'O nas'],
                'seo_h1'=>['en'=>'About Us', 'ru'=>'О нас', 'uk'=>'Про нас',  'pl'=>'O nas'],
                'slug'=>'about',
                'published'=>1,
            ],
            [
                'title'=>['en'=>'Our Documents', 'ru'=>'Наши Документы', 'uk'=>'Наші документи',  'pl'=>'Nasze dokumenty'],
                'seo_h1'=>['en'=>'Our Documents', 'ru'=>'Наши Документы', 'uk'=>'Наші документи',  'pl'=>'Nasze dokumenty'],
                'slug'=>'our-documents',
                'published'=>1,
            ],
            [
                'title'=>['en'=>'Guides', 'ru'=>'Экскурсоводы', 'uk'=>'Екскурсоводи',  'pl'=>'Przewodniki'],
                'seo_h1'=>['en'=>'Guides', 'ru'=>'Экскурсоводы', 'uk'=>'Екскурсоводи',  'pl'=>'Przewodniki'],
                'slug'=>'guides',
                'published'=>1,
            ],
            [
                'title'=>['en'=>'Office workers', 'ru'=>'Офисные работники', 'uk'=>'Офісні працівники',  'pl'=>'Pracownicy biurowi'],
                'seo_h1'=>['en'=>'Office workers', 'ru'=>'Офисные работники', 'uk'=>'Офісні працівники',  'pl'=>'Pracownicy biurowi'],
                'slug'=>'office-workers',
                'published'=>1,
            ],
//            [
//                'title'=>['en'=>'News', 'ru'=>'Новости', 'uk'=>'Новини',  'pl'=>'Aktualności'],
//                'seo_h1'=>['en'=>'News', 'ru'=>'Новости', 'uk'=>'Новини',  'pl'=>'Aktualności'],
//                'slug'=>'news',
//                'published'=>1,
//            ],
            [
                'title'=>['en'=>'Charity', 'ru'=>'Благотворительность', 'uk'=>'Благодійність',  'pl'=>'Dobroczynność'],
                'seo_h1'=>['en'=>'Charity', 'ru'=>'Благотворительность', 'uk'=>'Благодійність',  'pl'=>'Dobroczynność'],
                'slug'=>'charity',
                'published'=>1,
            ],
            [
                'title'=>['en'=>'Awards and honors', 'ru'=>'Награды и отличия', 'uk'=>'Нагороди та відзнаки',  'pl'=>'Nagrody i wyróżnienia'],
                'seo_h1'=>['en'=>'Awards and honors', 'ru'=>'Награды и отличия', 'uk'=>'Нагороди та відзнаки',  'pl'=>'Nagrody i wyróżnienia'],
                'slug'=>'awards-and-honors',
                'published'=>1,
            ],
            [
                'title'=>['en'=>'Vacancies', 'ru'=>'Bакансии', 'uk'=>'Вакансії',  'pl'=>'Wakaty'],
                'seo_h1'=>['en'=>'Vacancies', 'ru'=>'Bакансии', 'uk'=>'Вакансії',  'pl'=>'Wakaty'],
                'slug'=>'vacancies',
                'published'=>1,
            ],
            [
                'title'=>['en'=>'Practice', 'ru'=>'Практика', 'uk'=>'Практика',  'pl'=>'Ćwiczyć'],
                'seo_h1'=>['en'=>'Practice', 'ru'=>'Практика', 'uk'=>'Практика',  'pl'=>'Ćwiczyć'],
                'slug'=>'practice',
                'published'=>1,
            ],
//            [
//                'title'=>['en'=>'Reviews', 'ru'=>'Отзывы', 'uk'=>'Відгуки',  'pl'=>'Opinie'],
//                'seo_h1'=>['en'=>'Reviews', 'ru'=>'Отзывы', 'uk'=>'Відгуки',  'pl'=>'Opinie'],
//                'slug'=>'reviews',
//                'published'=>1,
//            ],
//            [
//                'title'=>['en'=>'Blog', 'ru'=>'Блог', 'uk'=>'Блог',  'pl'=>'Blog'],
//                'seo_h1'=>['en'=>'Blog', 'ru'=>'Блог', 'uk'=>'Блог',  'pl'=>'Blog'],
//                'slug'=>'blog',
//                'published'=>1,
//            ],
        ];

        foreach ($pages as $page) {

            Page::factory()->createOne($page);

        }
    }
}
