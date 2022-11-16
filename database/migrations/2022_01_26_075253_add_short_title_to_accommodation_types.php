<?php

use App\Models\AccommodationType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShortTitleToAccommodationTypes extends Migration
{
    public function up()
    {
        Schema::table('accommodation_types', function (Blueprint $table) {
            //
            
            $table->string('short_title')->nullable()->after('title');
        });

        $items = AccommodationType::get();
        foreach ($items as $item) {
            $item->title = Str::replace('р', 'p', trim($item->title));
            $item->title = Str::replace('о', 'o', trim($item->title));
            $item->short_title = trim(explode('/', $item->title)[0]);
            if ($item->title == '1o+') {
                $item->slug = \Illuminate\Support\Str::slug(Str::replace('+', '-plus', $item->title));
            } else {
                $item->slug = \Illuminate\Support\Str::slug(Str::replace('+', ' ', $item->title));
            }

            $item->save();
        }
    }

    public function down()
    {
        Schema::table('accommodation_types', function (Blueprint $table) {
            //
            $table->dropColumn('short_title');
        });
    }
}
