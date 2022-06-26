<?php

namespace Database\Seeders;

use App\Models\Packing;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class PackingSeeder extends Seeder
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
        $this->truncate('packings');

        $items = [
            [
                'title'=>['uk'=>'Коробка', 'ru'=>'Коробка', 'en'=>'Box', 'pl'=>'Skrzynka'],
                'slug'=>'box',
                'price'=> 35,
                'currency'=>'UAH',
                'icon'=>'/icon/box.svg',
            ],
            [
                'title'=>['uk'=>'Конверт', 'ru'=>'Конверт', 'en'=>'Envelope', 'pl'=>'Koperta'],
                'slug'=>'envelope',
                'price'=> 95,
                'currency'=>'UAH',
                'icon'=>'/icon/letter.svg',
            ],
            [
                'title'=>['uk'=>'Пляшка', 'ru'=>'Бутылка', 'en'=>'Bottle', 'pl'=>'Butelka'],
                'slug'=>'bottle',
                'price'=> 150,
                'currency'=>'UAH',
                'icon'=>'/icon/butl.svg',
            ],
        ];

        foreach ($items as $item) {
            Packing::query()->updateOrCreate(['slug' => $item['slug']], $item);
        }

        $this->enableForeignKeys();
    }
}
