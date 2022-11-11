<?php

namespace Database\Seeders;

use App\Models\Accommodation;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class AccommodationsSeeder extends Seeder
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
        $this->truncate('accommodations');

        $accommodations = [
            [
                'title' => [
                    'uk' => 'Садиби зеленого туризму Берегівського р-ну',
                ],
            ],
            [
                'title' => [
                    'uk' => 'Садиби зеленого туризму Верховинського р-ну',
                ],
            ],
        ];

        foreach ($accommodations as $accommodation) {
            Accommodation::create($accommodation);
        }

        $this->enableForeignKeys();
    }
}
