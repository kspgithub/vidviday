<?php

namespace Database\Seeders;

use App\Models\Finance;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class FinanceSeeder extends Seeder
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
        //
        $this->truncate('finances');


        Finance::factory()->count(10)->create();
        $this->enableForeignKeys();
    }
}
