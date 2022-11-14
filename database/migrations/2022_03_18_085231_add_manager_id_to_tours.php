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
            $tourManager = $tour->staff()->whereHas('types', fn ($t) => $t->where('slug', 'tour-manager'))->first();
            if ($tourManager) {
                $tour->manager_id = $tourManager->id;
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
