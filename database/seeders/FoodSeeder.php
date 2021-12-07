<?php

namespace Database\Seeders;

use App\Models\Food;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        //
        $this->truncate('food');


        Food::factory()->count(5)->create();
        $this->enableForeignKeys();

    }
}
