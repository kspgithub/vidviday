<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentColumnsToOrdersTable extends Migration
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
            $table->integer('payment_fop')->nullable()->default(0)->after('payment_comment');
            $table->integer('payment_tov')->nullable()->default(0)->after('payment_fop');
            $table->integer('payment_office')->nullable()->default(0)->after('payment_tov');
            $table->text('admin_comment')->nullable()->after('comment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->dropColumn([
                'payment_fop',
                'payment_tov',
                'payment_office',
                'admin_comment',
            ]);
        });
    }
}
