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
        $this->call(SiteOptionsSeeder::class);
        $this->call(HtmlBlockSeeder::class);

        $this->call(StaffTypeSeeder::class);
        $this->call(StaffSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(BlogSeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(BannerSeeder::class);
        $this->call(AchievementSeeder::class);
        $this->call(AdsSeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(EventsSeeder::class);
        $this->call(ContactSeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(PaymentTypeSeeder::class);
        $this->call(CountryRegionCitySeeder::class);

        $this->call(TourDirectionsSeeder::class);
        $this->call(TourGroupSeeder::class);
        $this->call(TourTypeSeeder::class);
        $this->call(TourSubjectSeeder::class);
        $this->call(BadgeSeeder::class);
        $this->call(FoodTimeSeeder::class);
        $this->call(FoodSeeder::class);
        $this->call(TicketsSeeder::class);
        $this->call(PlaceSeeder::class);
        $this->call(LandingPlaceSeeder::class);

        $this->call(AccommodationTypeSeeder::class);
        $this->call(AccommodationsSeeder::class);
        $this->call(IncludeTypeSeeder::class);
        $this->call(FinanceSeeder::class);
        $this->call(DiscountsSeeder::class);
        $this->call(VacancySeeder::class);
        $this->call(PackingSeeder::class);
        $this->call(DocumentsSeeder::class);
        $this->call(VisualOptionsSeeder::class);


        // Last
        $this->call(TourSeeder::class);
    }
}
