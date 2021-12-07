<?php

namespace Database\Seeders;

use App\Models\Direction;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class TourDirectionsSeeder extends Seeder
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
        $this->truncate('directions');
        $lorem = lipsum(10);
        $items = [
            ['title'=>['uk'=>'Волинь'], 'text'=>['uk'=>$lorem],  'published'=>1],
            ['title'=>['uk'=>'Буковина'], 'text'=>['uk'=>$lorem],  'published'=>1],
            ['title'=>['uk'=>'Галичина'], 'text'=>['uk'=>$lorem],  'published'=>1],
            ['title'=>['uk'=>'Карпати'], 'text'=>['uk'=>$lorem],  'published'=>1],
            ['title'=>['uk'=>'Херсонщина'], 'text'=>['uk'=>$lorem],  'published'=>1],
            ['title'=>['uk'=>'Львівщина'], 'text'=>['uk'=>$lorem],  'published'=>1],
        ];

        foreach ($items as $item) {
            Direction::create($item);
        }

        $this->enableForeignKeys();
    }
}
