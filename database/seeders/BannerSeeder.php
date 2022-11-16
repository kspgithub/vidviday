<?php

namespace Database\Seeders;

use App\Models\Banner;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
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
        $banners = Banner::all();
        foreach ($banners as $banner) {
            $banner->deleteImage();
        }
        $this->truncate('banners');


        Banner::factory()->count(3)->create();
    }
}
