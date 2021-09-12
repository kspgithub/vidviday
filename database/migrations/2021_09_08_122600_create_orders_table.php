<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('tour_id')->nullable()->constrained('tours')->nullOnDelete();
            $table->foreignId('schedule_id')->nullable()->constrained('tour_schedules')->nullOnDelete();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('group_type')->default(0);

            $table->date('start_date')->nullable();
            $table->string('start_place')->nullable();
            $table->date('end_date')->nullable();
            $table->string('end_place')->nullable();

            $table->string('order_number')->nullable();


            $table->integer('price')->default(0);
            $table->integer('commission')->default(0);
            $table->integer('discount')->default(0);
            $table->string('currency')->default('UAH');

            $table->text('discounts')->nullable();

            $table->boolean('children')->default(0);

            $table->string('tour_title')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('company')->nullable();
            $table->string('phone')->nullable();
            $table->string('viber')->nullable();
            $table->integer('places')->default(1);
            $table->text('comment')->nullable();

            $table->text('participants')->nullable();
            $table->text('accommodation')->nullable();
            $table->text('abolition')->nullable();

            $table->tinyInteger('program_type')->default(0);
            $table->text('tour_plan')->nullable();
            $table->text('group_comment')->nullable();
            $table->text('program_comment')->nullable();
            $table->text('price_include')->nullable();

            $table->tinyInteger('payment_type')->default(0);
            $table->tinyInteger('payment_status')->default(0);

            $table->tinyInteger('confirmation_type')->default(0);
            $table->tinyInteger('confirmation_status')->default(0);
            $table->date('offer_date')->nullable();

            $table->string('act')->nullable();
            $table->string('invoice')->nullable();
            $table->string('info_sheet')->nullable();

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
        Schema::dropIfExists('orders');
    }
}
