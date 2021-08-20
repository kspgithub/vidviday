<?php

namespace Database\Seeders;

use App\Models\Staff;
use App\Models\StaffType;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
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
        $this->truncate('staff');

        $types = StaffType::all();

        Staff::factory()->count(20)->create()->each(function (Staff $item) use ($types) {
            $item->types()->sync($types->random(1)->pluck('id')->toArray());
        });

        $this->enableForeignKeys();
    }
}
