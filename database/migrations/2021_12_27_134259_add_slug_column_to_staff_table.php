<?php

use App\Models\Staff;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugColumnToStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('staff', function (Blueprint $table) {
            //
            $table->json('slug')->nullable()->after('last_name');
        });

        $items = Staff::all();
        foreach ($items as $item) {
            $item->slug = ['uk' => \Illuminate\Support\Str::slug($item->last_name.' '.$item->first_name)];
            $item->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('staff', function (Blueprint $table) {
            //
            $table->dropColumn('slug');
        });
    }
}
