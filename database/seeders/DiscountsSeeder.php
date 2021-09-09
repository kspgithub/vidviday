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

        Discount::factory()->count(10)->create();

        $this->enableForeignKeys();
    }
}
