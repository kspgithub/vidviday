<?php

namespace Database\Seeders;

use App\Models\FaqItem;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
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
        $this->truncate('faq_items');

        FaqItem::factory()->count(100)->create();
    }
}
