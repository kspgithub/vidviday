<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUtmColumnsToAgencySubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agency_subscriptions', function (Blueprint $table) {
            //
            $table->string('bitrix_id')->nullable()->after('id');
            $table->string('bitrix_contact_id')->nullable()->after('bitrix_id');
            $table->string('utm_campaign')->nullable()->after('viber');
            $table->string('utm_content')->nullable()->after('utm_campaign');
            $table->string('utm_medium')->nullable()->after('utm_content');
            $table->string('utm_source')->nullable()->after('utm_medium');
            $table->string('utm_term')->nullable()->after('utm_source');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agency_subscriptions', function (Blueprint $table) {
            //
            $table->dropColumn('bitrix_id');
            $table->dropColumn('bitrix_contact_id');
            $table->dropColumn('utm_campaign');
            $table->dropColumn('utm_content');
            $table->dropColumn('utm_medium');
            $table->dropColumn('utm_source');
            $table->dropColumn('utm_term');
        });
    }
}
