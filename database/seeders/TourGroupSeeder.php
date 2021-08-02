<?php

namespace Database\Seeders;

use App\Models\TourGroup;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class TourGroupSeeder extends Seeder
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
        $this->truncate('tour_groups');
        $lorem = lipsum(10);
        $items = [
            ['title'=>['uk'=>'Популярні тури'], 'text'=>['uk'=>$lorem],  'published'=>1],
            ['title'=>['uk'=>'Тури на Синевир'], 'text'=>['uk'=>$lorem],  'published'=>1],
            ['title'=>['uk'=>'Тури на Новий Рік'], 'text'=>['uk'=>$lorem],  'published'=>1],
            ['title'=>['uk'=>'Тури на Різдво'], 'text'=>['uk'=>$lorem],  'published'=>1],
            ['title'=>['uk'=>'Тури в Карпати'], 'text'=>['uk'=>$lorem],  'published'=>1],
            ['title'=>['uk'=>'На бринзу до Рахова'], 'text'=>['uk'=>$lorem],  'published'=>1],
        ];

        foreach ($items as $item) {
            TourGroup::create($item);
        }

        $this->enableForeignKeys();
    }
}
