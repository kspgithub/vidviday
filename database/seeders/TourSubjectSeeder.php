<?php

namespace Database\Seeders;

use App\Models\TourSubject;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class TourSubjectSeeder extends Seeder
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
        $this->truncate('tour_subjects');
        $lorem = lipsum(10);
        $items = [
            ['title'=>['uk'=>'Історичні екскурсії'], 'text'=>['uk'=>$lorem],  'published'=>1],
            ['title'=>['uk'=>'Природознавчі екскурсії'], 'text'=>['uk'=>$lorem],  'published'=>1],
            ['title'=>['uk'=>'Мистецтвознавчі екскурсії'], 'text'=>['uk'=>$lorem],  'published'=>1],
            ['title'=>['uk'=>'Літературні екскурсії'], 'text'=>['uk'=>$lorem],  'published'=>1],
            ['title'=>['uk'=>'Виробничі екскурсії'], 'text'=>['uk'=>$lorem],  'published'=>1],
            ['title'=>['uk'=>'Архітектурні екскурсії'], 'text'=>['uk'=>$lorem],  'published'=>1],
            ['title'=>['uk'=>'Культово-релігійні екскурсії'], 'text'=>['uk'=>$lorem],  'published'=>1],
        ];

        foreach ($items as $item) {
            TourSubject::create($item);
        }

        $this->enableForeignKeys();
    }
}
