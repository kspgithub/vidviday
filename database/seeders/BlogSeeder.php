<?php

namespace Database\Seeders;

use App\Models\Post;
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

        Post::factory()->count(30)->create();
    }
}
