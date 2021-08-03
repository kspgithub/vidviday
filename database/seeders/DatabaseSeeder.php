<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AuthSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(CurrencySeeder::class);
        //$this->call(LocationSeeder::class);
        $this->call(TourDirectionsSeeder::class);
        $this->call(BadgeSeeder::class);
        $this->call(CountryRegionCitySeeder::class);
        $this->call(FoodTimeSeeder::class);
        $this->call(StaffTypeSeeder::class);
    }
}
