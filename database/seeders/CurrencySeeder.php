<?php

namespace Database\Seeders;

use App\Models\Currency;
use Artisan;
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
                'title' => [
                    'uk' => 'грн.',
                    'ru' => 'грн.',
                    'en' => 'uah',
                    'pl' => 'uah',
                ],
                'symbol' => '₴',
                'iso' => 'UAH',
                'slug' => 'uah',
                'course' => 1,
            ],
            [
                'title' => [
                    'uk' => 'дол.',
                    'ru' => 'дол.',
                    'en' => 'usd',
                    'pl' => 'usd',
                ],
                'symbol' => '$',
                'iso' => 'USD',
                'slug' => 'usd',
                'course' => 1,
            ],
            [
                'title' => [
                    'uk' => 'евро.',
                    'ru' => 'евро.',
                    'en' => 'eur',
                    'pl' => 'eur',
                ],
                'symbol' => '€',
                'iso' => 'EUR',
                'slug' => 'eur',
                'course' => 1,
            ],
            [
                'title' => [
                    'uk' => 'фунт.',
                    'ru' => 'фунт.',
                    'en' => 'gbp',
                    'pl' => 'gbp',
                ],
                'symbol' => '£',
                'iso' => 'GBP',
                'slug' => 'gbp',
                'course' => 1,
            ],
            [
                'title' => [
                    'uk' => 'злт.',
                    'ru' => 'злт.',
                    'en' => 'pln',
                    'pl' => 'pln',
                ],
                'symbol' => 'zł',
                'iso' => 'PLN',
                'slug' => 'pln',
                'course' => 1,
            ],
        ];

        foreach ($items as  $item) {
            Currency::create($item);
        }
        Artisan::call('currency:update-rate');
        $this->enableForeignKeys();
    }
}
