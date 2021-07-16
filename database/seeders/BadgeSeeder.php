<?php

namespace Database\Seeders;

use App\Models\Badge;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class BadgeSeeder extends Seeder
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

        $this->truncateMultiple(['tour_badges', 'badges']);

        $badges = [
            ['title' => ['ru' => 'Новинка', 'uk' => 'Новинка', 'en' => 'New', 'pl' => 'Nowy'], 'slug' => 'new', 'color' => '#7EBD3E'],
            ['title' => ['ru' => 'Акция', 'uk' => 'Акція', 'en' => 'Promo', 'pl' => 'Зromocja'], 'slug' => 'promo', 'color' => '#FFB947'],
        ];

        foreach ($badges as $badge) {
            Badge::create($badge);
        }

        $this->enableForeignKeys();
    }
}
