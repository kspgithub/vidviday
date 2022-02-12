<?php

use App\Models\Discount;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypeColumnInDiscounts extends Migration
{
    public function up()
    {
        Schema::table('discounts', function (Blueprint $table) {
            //
            $table->string('type')->default('value')->change();
        });

        Discount::where('type', '=', '0')->update(['type' => 'value']);
        Discount::where('type', '=', '1')->update(['type' => 'percent']);
    }

    public function down()
    {
        Discount::where('type', '=', 'value')->update(['type' => '0']);
        Discount::where('type', '=', 'percent')->update(['type' => '1']);

        Schema::table('discounts', function (Blueprint $table) {
            //
            $table->integer('type')->default(0)->change();
        });
    }
}
