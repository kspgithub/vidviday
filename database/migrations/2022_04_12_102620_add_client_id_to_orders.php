<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClientIdToOrders extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->foreignId('contact_id')->nullable()->after('user_id')->constrained('bitrix_contacts')->nullOnDelete();
        });

        \App\Models\Order::each(function ($order) {
            $order->syncContact();
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->dropForeign('orders_contact_id_foreign');
            $table->dropColumn('contact_id');
        });
    }
}
