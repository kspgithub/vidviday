<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class TicketsSeeder extends Seeder
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
        $this->truncate('tickets');

        Ticket::factory()->count(10)->create();
        $this->enableForeignKeys();
    }
}
