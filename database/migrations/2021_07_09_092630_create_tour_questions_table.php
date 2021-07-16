<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('tour_id')->nullable()->constrained('tours')->nullOnDelete();
            $table->unsignedBigInteger('parent_id')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->integer('rating')->default(0);
            $table->string('avatar')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('text')->nullable();
            $table->text('attachments')->nullable();
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
        Schema::dropIfExists('tour_questions');
    }
}
