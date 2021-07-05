<?php

namespace Database\Seeders;

use App\Models\Currency;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
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
        $this->truncate('currencies');

        $items = [
            [
                'title'=>'грн.',
                'symbol'=>'₴',
                'iso'=>'UAH',
                'slug'=>'uah',
                'course'=>1,
            ],
            [
                'title'=>'дол.',
                'symbol'=>'$',
                'iso'=>'USD',
                'slug'=>'usd',
                'course'=>1,
            ],
            [
                'title'=>'евро',
                'symbol'=>'€',
                'iso'=>'EUR',
                'slug'=>'eur',
                'course'=>1,
            ],
            [
                'title'=>'фунт.',
                'symbol'=>'£',
                'iso'=>'GBP',
                'slug'=>'gbp',
                'course'=>1,
            ],
            [
                'title'=>'злт.',
                'symbol'=>'zł',
                'iso'=>'PLN',
                'slug'=>'pln',
                'course'=>1,
            ],
        ];

        foreach ($items as  $item) {
            Currency::create($item);
        }

        $this->enableForeignKeys();
    }
}
