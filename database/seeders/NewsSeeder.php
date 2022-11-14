<?php

namespace Database\Seeders;

use App\Models\News;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
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
        $this->truncate('news');

        News::factory()->count(30)->create();
    }
}
