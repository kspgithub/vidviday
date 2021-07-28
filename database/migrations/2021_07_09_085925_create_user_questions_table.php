<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     * Заказ звонка или письмо от пользователя
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_questions', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('question_type')->nullable();
            $table->text('comment')->nullable();
            $table->timestamp('call_date')->nullable();
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
        Schema::dropIfExists('call_orders');
    }
}
