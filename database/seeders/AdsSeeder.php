<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class AdsSeeder extends Seeder
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
        $this->truncate('advertisements');

        $items = [
            [
                'title'=>['uk'=>'Кількість днів'],
                'url'=>['uk'=>''],
                'text'=>['uk'=>'В карточці туру ви можете дізнатись вільні дати, тривалість туру, а також потрібну кількість людей.'],
                'published'=>1
            ],
        ];

        foreach ($items as $item) {
            Advertisement::create($item);
        }

    }
}
