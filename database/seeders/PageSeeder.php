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
        $pages = [
            [
                'title'=>['en'=>'About Us', 'ru'=>'О нас', 'uk'=>'Про нас',  'pl'=>'O nas'],
                'seo_h1'=>['en'=>'About Us', 'ru'=>'О нас', 'uk'=>'Про нас',  'pl'=>'O nas'],
                'slug'=>'about',
                'published'=>1,
            ],
        ];

        foreach ($pages as $page) {
            Page::create($page);
        }
    }
}
