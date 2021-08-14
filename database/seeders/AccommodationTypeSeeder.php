<?php

namespace Database\Seeders;

use App\Models\AccommodationType;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class AccommodationTypeSeeder extends Seeder
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
        $this->truncate('accommodation_types');

        $types = [
            ['title' => '1о+', 'slug' => '1о-plus', 'description' => ['uk' => 'підселення в двомісний або тримісний номер до інших учасників туру такої самої статі']],
            ['title' => '1o / SGL', 'slug' => '1о-sgl', 'description' => ['uk' => 'одномісний номер']],
            ['title' => '2o / TWN', 'slug' => '2о-twn', 'description' => ['uk' => 'двомісний номер з двома окремими ліжками']],
            ['title' => '2p / DBL', 'slug' => '2p-dbl', 'description' => ['uk' => 'двомісний номер з одним двоспальним ліжком']],
            ['title' => '3о / TRPL', 'slug' => '3о-trpl', 'description' => ['uk' => 'тримісний номер з трьома односпальними ліжками']],
            ['title' => '2р+1о / TRPL', 'slug' => '2р-1о-trpl', 'description' => ['uk' => 'тримісний номер з одним двоспальним ліжком та одним односпальним ліжком']],
            ['title' => '4о / QDPL', 'slug' => '4о-qdpl', 'description' => ['uk' => 'чотиримісний номер з чотирма окремими ліжками']],
            ['title' => ' 2р+2р / QDPL', 'slug' => ' 2р-2р-qdpl', 'description' => ['uk' => 'чотиримісний номер з двома двоспальними ліжками']],
        ];

        foreach ($types as $type) {
            AccommodationType::create($type);
        }

        $this->enableForeignKeys();
    }
}
