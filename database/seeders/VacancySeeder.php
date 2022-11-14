<?php

namespace Database\Seeders;

use App\Models\Vacancy;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class VacancySeeder extends Seeder
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
        $this->truncate('vacancies');

        Vacancy::factory()->count(10)->create();
    }
}
