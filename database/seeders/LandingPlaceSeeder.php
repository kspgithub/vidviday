<?php

namespace Database\Seeders;

use App\Models\LandingPlace;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class LandingPlaceSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;

    public function run()
    {
        //
        $this->disableForeignKeys();
        $this->truncate('landing_places');

        LandingPlace::factory()->count(10)->create();

        $this->enableForeignKeys();
    }
}
