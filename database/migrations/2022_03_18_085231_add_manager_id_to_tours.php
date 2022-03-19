<?php

use App\Models\Tour;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddManagerIdToTours extends Migration
{
    public function up()
    {
        Schema::table('tours', function (Blueprint $table) {
            //
            $table->foreignId('manager_id')->after('id')->nullable()->constrained('staff')->nullOnDelete();
        });


        Tour::all()->each(function ($tour) {
            if (!empty($tour->tour_manager)) {
                $tour->manager_id = $tour->tour_manager->id;
                $tour->save();
            }
        });
    }

    public function down()
    {
        Schema::table('tours', function (Blueprint $table) {
            //
            $table->dropColumn('tours_manager_id_foreign');
            $table->dropColumn('manager_id');
        });
    }
}
