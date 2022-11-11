<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalFieldsToToursTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tours_tickets', function (Blueprint $table) {
            $table->integer('type_id')->nullable()->default(0);

            $table->foreignId('region_id')->nullable()->constrained('regions')->nullOnDelete();

            $table->json('slug')->nullable();
            $table->decimal('price')->nullable()->default(0);
            $table->string('currency')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tours_tickets', function (Blueprint $table) {
            $table->dropForeign('tours_tickets_region_id_foreign');

            $table->dropColumn([
                'type_id',
                'region_id',
                'slug',
                'price',
                'currency',
            ]);
        });
    }
}
