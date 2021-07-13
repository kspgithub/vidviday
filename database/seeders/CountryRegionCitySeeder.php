<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use GuzzleHttp\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CountryRegionCitySeeder extends Seeder
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
        $this->truncateMultiple(['cities', 'regions', 'countries']);


        /** 1. Empty 3 tables **/
        DB::statement('truncate table countries');
        DB::statement('truncate table regions');
        DB::statement('truncate table cities');


        /** 2. Add data from MySQL file **/
        $CountryRegionCity = file_get_contents(__DIR__ . "/CountryRegionCity.sql");
        $arrStatements = explode('/*---*/', $CountryRegionCity);
        foreach($arrStatements as $statement) {
            DB::statement($statement);
        }


        /** 3. Convert data from MySQL to "Region" and "City" models **/
        //$located_countrys = collect(DB::select('select * from located_countrys'))->toArray();
        // Create [1 => Україна]
        $country = Country::factory()->createOne([
            'title'=>[
               'uk'=>'Україна',
               'ru'=>'Украина',
               'en'=>'Ukraine',
               'pl'=>'Ukraina',
            ],
            'slug'=>'ukraine',
            'iso'=>'UA',
        ]);

        $located_region = collect(DB::select('select * from located_region'))->toArray();
        //$located_area = DB::select('select * from located_area');
        $located_village = collect(DB::select('select * from located_village'))->toArray();

        // regions
        foreach ($located_region as $region_data) {
                $region = Region::factory()->createOne([
                    'country_id' => 1,
                    'title'=>[
                        'uk' => $region_data->region,
                    ],
                    'slug' => Str::slug($region_data->region)
                ]);
        }

        // cities
        foreach ($located_village as $city_data) {
            $city = City::factory()->createOne([
                'country_id' => 1,
                'region_id' => $city_data->region,
                'title' => [
                    'uk' => $city_data->village,
                ],
                'slug' => Str::slug($city_data->village)
            ]);
        }



        // 4. Delete secondary data from DB
        DB::statement('drop table located_area');
        DB::statement('drop table located_countrys');
        DB::statement('drop table located_region');
        DB::statement('drop table located_village');


        $this->enableForeignKeys();
    }
}
