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
        $this->call(CountryRegionCitySeeder::class);

        $this->call(TourDirectionsSeeder::class);
        $this->call(TourGroupSeeder::class);
        $this->call(TourTypeSeeder::class);
        $this->call(TourSubjectSeeder::class);
        $this->call(BadgeSeeder::class);
        $this->call(FoodTimeSeeder::class);
        $this->call(PlaceSeeder::class);
        $this->call(StaffTypeSeeder::class);
        $this->call(StaffSeeder::class);
        $this->call(AccommodationTypeSeeder::class);
        $this->call(AccommodationsSeeder::class);

        // Last
        $this->call(TourSeeder::class);
    }
}
