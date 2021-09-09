<?php

namespace Database\Seeders;

use App\Models\IncludeType;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class IncludeTypeSeeder extends Seeder
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
        $this->truncate('include_types');
        //
        $items = [
            [
                'title' => [
                    'uk' => 'У вартість туру входить',
                    'ru' => 'В стоимость тура входит',
                    'en' => 'The tour price includes',
                    'pl' => 'Cena wycieczki obejmuje',
                ]
            ],
            [
                'title' => [
                    'uk' => 'У вартість не входять і додатково оплачуються',
                    'ru' => 'В стоимость не входят и дополнительно оплачиваются',
                    'en' => 'The price does not include and is paid additionally',
                    'pl' => 'Cena nie obejmuje i jest dodatkowo płatna',
                ]
            ],
            [
                'title' => [
                    'uk' => 'Знижки',
                    'ru' => 'Cкидки',
                    'en' => 'Discounts',
                    'pl' => 'Rabaty',
                ]
            ],
        ];
        foreach ($items as $item) {
            IncludeType::create($item);
        }

        $this->enableForeignKeys();
    }
}
