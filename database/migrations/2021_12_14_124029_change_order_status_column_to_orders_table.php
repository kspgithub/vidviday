<?php

use App\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChangeOrderStatusColumnToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->string('status')->default('new')->change();
        });

        DB::table('orders')->where('status', '0')->update(['status' => Order::STATUS_NEW]);
        DB::table('orders')->where('status', '1')->update(['status' => Order::STATUS_BOOKED]);
        DB::table('orders')->where('status', '2')->update(['status' => Order::STATUS_BOOKED]);
        DB::table('orders')->where('status', '3')->update(['status' => Order::STATUS_PAYED]);
        DB::table('orders')->where('status', '4')->update(['status' => Order::STATUS_COMPLETED]);
        DB::table('orders')->where('status', '5')->update(['status' => Order::STATUS_RESERVE]);
        DB::table('orders')->where('status', '6')->update(['status' => Order::STATUS_PENDING_CANCEL]);
        DB::table('orders')->where('status', '7')->update(['status' => Order::STATUS_CANCELED]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('orders')->where('status', Order::STATUS_NEW)->update(['status' => 0]);
        DB::table('orders')->where('status', Order::STATUS_BOOKED)->update(['status' => 1]);
        DB::table('orders')->where('status', Order::STATUS_PAYED)->update(['status' => 3]);
        DB::table('orders')->where('status', Order::STATUS_COMPLETED)->update(['status' => 4]);
        DB::table('orders')->where('status', Order::STATUS_RESERVE)->update(['status' => 5]);
        DB::table('orders')->where('status', Order::STATUS_PENDING_CANCEL)->update(['status' => 6]);
        DB::table('orders')->where('status', Order::STATUS_CANCELED)->update(['status' => 4]);

        Schema::table('orders', function (Blueprint $table) {
            //
            $table->integer('status')->default(0)->change();
        });
    }
}
