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
            ['title' => '1o+', 'slug' => '1o-plus', 'description' => ['uk' => 'підселення в двомісний або тримісний номер до інших учасників туру такої самої статі']],
            ['title' => '1o / SGL', 'slug' => '1o-sgl', 'description' => ['uk' => 'одномісний номер']],
            ['title' => '2o / TWN', 'slug' => '2o-twn', 'description' => ['uk' => 'двомісний номер з двома окремими ліжками']],
            ['title' => '2p / DBL', 'slug' => '2p-dbl', 'description' => ['uk' => 'двомісний номер з одним двоспальним ліжком']],
            ['title' => '3o / TRPL', 'slug' => '3o-trpl', 'description' => ['uk' => 'тримісний номер з трьома односпальними ліжками']],
            ['title' => '2p+1o / TRPL', 'slug' => '2p-1o-trpl', 'description' => ['uk' => 'тримісний номер з одним двоспальним ліжком та одним односпальним ліжком']],
            ['title' => '4o / QDPL', 'slug' => '4o-qdpl', 'description' => ['uk' => 'чотиримісний номер з чотирма окремими ліжками']],
            ['title' => '2p+2p / QDPL', 'slug' => '2p-2p-qdpl', 'description' => ['uk' => 'чотиримісний номер з двома двоспальними ліжками']],
        ];

        foreach ($types as $type) {
            AccommodationType::create($type);
        }

        $this->enableForeignKeys();
    }
}
