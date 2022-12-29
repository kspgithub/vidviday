<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = json_decode(file_get_contents(database_path('data/countries.json')), true);

        foreach ($countries as $country) {
            Country::query()->firstOrCreate(['iso' => $country['iso']], $country);
        }
    }
}
