<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeJsonColumnTypesToText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('media', function (Blueprint $table) {
            //
            $table->text('manipulations')->change();
            $table->text('custom_properties')->change();
            $table->text('generated_conversions')->change();
            $table->text('responsive_images')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('media', function (Blueprint $table) {
            //
            $table->json('manipulations')->change();
            $table->json('custom_properties')->change();
            $table->json('generated_conversions')->change();
            $table->json('responsive_images')->change();
        });
    }
}
