<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->call(AuthSeeder::class);
        $this->call(SiteOptionsSeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(HtmlBlockSeeder::class);
        $this->call(StaffTypeSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(AchievementSeeder::class);
        $this->call(AdsSeeder::class);
        $this->call(ContactSeeder::class);
        $this->call(PaymentTypeSeeder::class);
        $this->call(CountryRegionCitySeeder::class);
        $this->call(TourDirectionsSeeder::class);
        $this->call(TourGroupSeeder::class);
        $this->call(TourTypeSeeder::class);
        $this->call(TourSubjectSeeder::class);
        $this->call(BadgeSeeder::class);
        $this->call(FoodTimeSeeder::class);
        $this->call(AccommodationTypeSeeder::class);
        $this->call(IncludeTypeSeeder::class);
        $this->call(DiscountsSeeder::class);
        $this->call(PackingSeeder::class);
        $this->call(OurClientSeeder::class);
        $this->call(DocumentsSeeder::class);
    }
}
