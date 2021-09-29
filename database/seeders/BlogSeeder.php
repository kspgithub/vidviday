<?php

namespace Database\Seeders;

use App\Models\Blog;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
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

        $this->truncate('blogs');

        Blog::factory()->count(30)->create();
    }
}
