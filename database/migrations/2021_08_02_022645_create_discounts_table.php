<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('slug');
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('percentage', 10, 2)->default(0);
            $table->integer('duration')->default(1);
            $table->boolean('published')->default(1);
            $table->string('currency')->nullable()->default('UAH');

            $table->unsignedBigInteger('model_nameable_id');
            $table->string('model_nameable_type');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discounts');
    }
}
