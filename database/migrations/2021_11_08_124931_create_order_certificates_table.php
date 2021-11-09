<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_certificates', function (Blueprint $table) {
            $table->id();

            $table->string('bitrix_id')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('tour_id')->nullable()->constrained('tours')->nullOnDelete();
            $table->tinyInteger('status')->default(0);
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('first_name_recipient')->nullable();
            $table->string('last_name_recipient')->nullable();

            $table->string('order_number')->nullable();
            $table->string('type')->nullable();
            $table->string('design')->nullable();
            $table->string('format')->nullable();
            $table->boolean('packing')->nullable()->default(0);
            $table->string('packing_type')->nullable();
            $table->integer('places')->nullable();
            $table->integer('sum')->nullable();
            $table->integer('price')->default(0);
            $table->string('currency')->default('UAH');
            $table->tinyInteger('payment_type')->default(0);
            $table->tinyInteger('payment_status')->default(0);
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_certificates');
    }
}
