<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use GuzzleHttp\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LocationSeeder extends Seeder
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

        $url = 'https://api.hh.ru/areas/5';
        $client = new Client();
        $response = $client->get($url);
        if ($response->getStatusCode() === 200) {
            $json = json_decode($response->getBody(), true);
            foreach ($json['areas'] as $region_data) {
                $region = Region::factory()->createOne([
                    'country_id'=>$country->id,
                    'title'=>[
                        'ru'=>$region_data['name'],
                        'uk'=>$region_data['name'],
                    ],
                    'slug'=>Str::slug($region_data['name'])
                ]);

                foreach ($region_data['areas'] as $city_data) {
                    $city = City::factory()->createOne([
                        'country_id'=>$country->id,
                        'region_id'=>$region->id,
                        'title'=>[
                            'ru'=>$city_data['name'],
                            'uk'=>$city_data['name'],
                        ],
                        'slug'=>Str::slug($city_data['name'])
                    ]);
                }
            }
        }

        $this->enableForeignKeys();
    }
}
