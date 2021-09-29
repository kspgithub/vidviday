<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChildrenColumnsToDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('discounts', function (Blueprint $table) {
            //
            $table->string('category')->after('type')->default('all');
            $table->string('duration')->after('type')->default('order');
            $table->boolean('age_limit')->default(0);
            $table->integer('age_start')->nullable(0);
            $table->integer('age_end')->nullable(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('discounts', function (Blueprint $table) {
            //
            $table->dropColumn([
                'category',
                'duration',
                'age_limit',
                'age_start',
                'age_end',
            ]);
        });
    }
}
