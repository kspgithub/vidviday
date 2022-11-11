<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('faq_items', function (Blueprint $table) {
            $table->json('question')->nullable()->change();
            $table->json('answer')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('faq_items', function (Blueprint $table) {
            $table->text('question')->nullable()->change();
            $table->text('answer')->nullable()->change();
        });
    }
};
