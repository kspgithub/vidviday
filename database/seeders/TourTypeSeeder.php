<?php

namespace Database\Seeders;

use App\Models\TourType;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class TourTypeSeeder extends Seeder
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
        $this->truncate('tour_types');
        $lorem = lipsum(10);
        $items = [
            ['title'=>['uk'=>'Походи в гори'], 'text'=>['uk'=>$lorem],  'published'=>1],
            ['title'=>['uk'=>'Тури на море'], 'text'=>['uk'=>$lorem],  'published'=>1],
            ['title'=>['uk'=>'Тури вихідного дня'], 'text'=>['uk'=>$lorem],  'published'=>1],
        ];

        foreach ($items as $item) {
            TourType::create($item);
        }

        $this->enableForeignKeys();
    }
}
