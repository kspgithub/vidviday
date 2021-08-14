<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourAccommodationTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_accomm_types', function (Blueprint $table) {
            $table->unsignedBigInteger('accomm_id');
            $table->unsignedBigInteger('type_id');

            $table->foreign('accomm_id', 'tacm_acm_id_foreign')
                ->references('id')
                ->on('tour_accommodations')->cascadeOnDelete();

            $table->foreign('type_id', 'acm_type_id_foreign')
                ->references('id')
                ->on('accommodation_types')->cascadeOnDelete();

            $table->primary(['accomm_id', 'type_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tour_accommodation_types');
    }
}
