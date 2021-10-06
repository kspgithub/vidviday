<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\Region;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
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

        $this->truncateMultiple(['cities', 'regions', 'districts', 'countries']);

        /** 1. Empty 3 tables **/
        DB::statement('truncate table countries');
        DB::statement('truncate table regions');
        DB::statement('truncate table cities');
        DB::statement('truncate table districts');

        DB::statement('drop table if exists located_area');
        DB::statement('drop table if exists located_countrys');
        DB::statement('drop table if exists located_region');
        DB::statement('drop table if exists located_village');

        /** 2. Add data from MySQL file **/
        $CountryRegionCity = file_get_contents(__DIR__ . "/CountryRegionCity.sql");
        $arrStatements = array_filter(explode('/*---*/', $CountryRegionCity));
        foreach ($arrStatements as $statement) {
            DB::statement($statement);
        }

        /** 3. Convert data from MySQL to "Region" and "City" models **/
        //$located_countrys = collect(DB::select('select * from located_countrys'))->toArray();
        // Create [1 => Україна]
        $country = Country::factory()->createOne([
            'id'=> Country::DEFAULT_COUNTRY_ID,
            'title'=>[
               'uk'=>'Україна',
               'ru'=>'Украина',
               'en'=>'Ukraine',
               'pl'=>'Ukraina',
            ],
            'slug'=>'ukraine',
            'iso'=>'UA',
        ]);

        $located_region = collect(DB::select('select * from located_region'))->map(function ($reg) {
            return [
                'country_id' => Country::DEFAULT_COUNTRY_ID,
                'title' => json_encode([
                    'uk' => $reg->region,
                ], JSON_UNESCAPED_UNICODE),
                'slug' => Str::slug($reg->region)
            ];
        })->toArray();
        Region::insert($located_region);


        $located_area = collect(DB::select('select * from located_area'))->map(function ($area) {
            return [
                'country_id' => Country::DEFAULT_COUNTRY_ID,
                'region_id' => $area->region,
                'title' => json_encode([
                    'uk' => $area->area,
                ], JSON_UNESCAPED_UNICODE),
                'slug' => Str::slug($area->region)
            ];
        })->toArray();
        District::insert($located_area);

        //$located_area = DB::select('select * from located_area');
        $located_village_chunks = collect(DB::select('select * from located_village'))->unique(function ($vil) {
            return $vil->region . $vil->village;
        })->map(function ($vil) {
            return [
                'country_id' => 1,
                'region_id' => $vil->region,
                'district_id' => $vil->area,
                'title' => json_encode([
                    'uk' => $vil->village,
                ], JSON_UNESCAPED_UNICODE),
                'slug' => $vil->region . '-' . Str::slug($vil->village)
            ];
        })->chunk(100);

        foreach ($located_village_chunks as $village_chunk) {
            City::insert($village_chunk->toArray());
        }


        // 4. Delete secondary data from DB
        DB::statement('drop table located_area');
        DB::statement('drop table located_countrys');
        DB::statement('drop table located_region');
        DB::statement('drop table located_village');

        $this->enableForeignKeys();
    }
}
