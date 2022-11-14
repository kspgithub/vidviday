<?php

namespace Database\Seeders;

use App\Models\Discount;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class DiscountsSeeder extends Seeder
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

        $this->truncateMultiple([
            'tours_discounts',
            'discounts',
        ]);

        Discount::create([
            'title' => [
                'uk' => 'Діти до 3 років — безкоштовно',
            ],
            'type' => 1,
            'price' => 100,
            'currency' => 'UAH',
            'age_limit' => 1,
            'age_start' => 0,
            'age_end' => 3,
            'category' => Discount::CATEGORY_CHILDREN_YOUNG,
            'duration' => Discount::DURATION_PERSON,
        ]);

        Discount::create([
            'title' => [
                'uk' => 'Діти до 6 років — безкоштовно',
            ],
            'type' => 1,
            'price' => 100,
            'currency' => 'UAH',
            'age_limit' => 1,
            'age_start' => 0,
            'age_end' => 6,
            'category' => Discount::CATEGORY_CHILDREN_YOUNG,
            'duration' => Discount::DURATION_PERSON,
        ]);

        Discount::create([
            'title' => [
                'uk' => 'Діти від 3 до 12 років - 50%',
            ],
            'type' => 1,
            'price' => 50,
            'currency' => 'UAH',
            'age_limit' => 1,
            'age_start' => 3,
            'age_end' => 12,
            'category' => Discount::CATEGORY_CHILDREN_OLDER,
            'duration' => Discount::DURATION_PERSON,
        ]);

        Discount::create([
            'title' => [
                'uk' => 'Діти від 6 до 12 років -50 грн.(за кожен день туру)',
            ],
            'type' => 0,
            'price' => 50,
            'currency' => 'UAH',
            'age_limit' => 1,
            'age_start' => 6,
            'age_end' => 12,
            'category' => Discount::CATEGORY_CHILDREN_OLDER,
            'duration' => Discount::DURATION_PERSON_DAY,
        ]);

        $this->enableForeignKeys();
    }
}
