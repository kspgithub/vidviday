<?php

use App\Models\Discount;
use App\Models\TourDiscount;
use Doctrine\DBAL\Schema\ForeignKeyConstraint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddAdditionalFieldsToToursDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $conn = Schema::getConnection()->getDoctrineSchemaManager();

        $foreignKeys = array_map(function(ForeignKeyConstraint $foreignKey) {
            return $foreignKey->getName();
        }, $conn->listTableForeignKeys('tours_discounts'));

        $primary = $conn->listTableIndexes('tours_discounts')['primary'] ?? null;
        $primaryColumns = $primary?->getColumns() ?? null;

        Schema::table('tours_discounts', function (Blueprint $table) use ($foreignKeys, $primaryColumns) {
            if(in_array('discounts_tours_discount_id_foreign', $foreignKeys)) {
                $table->dropForeign('discounts_tours_discount_id_foreign');
            }
            if(in_array('discounts_tours_tour_id_foreign', $foreignKeys)) {
                $table->dropForeign('discounts_tours_tour_id_foreign');
            }

            if($primaryColumns)
                $table->dropPrimary($primaryColumns);
        });

        Schema::table('tours_discounts', function (Blueprint $table) {
            $table->id()->first();
            $table->unsignedBigInteger('discount_id')->nullable()->change();
            $table->integer('type_id')->nullable()->default(0);
            $table->text('title')->nullable();
            $table->string('admin_title')->nullable();
            $table->string('type')->nullable()->default(Discount::TYPE_VALUE);
            $table->string('duration')->nullable()->default(Discount::DURATION_ORDER);
            $table->string('category')->nullable()->default(Discount::CATEGORY_ALL);
            $table->decimal('price')->nullable()->default(0);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('currency')->nullable();
            $table->tinyInteger('age_limit')->nullable()->default(0);
            $table->integer('age_start')->nullable();
            $table->integer('age_end')->nullable();

            $table->foreign('tour_id', 'discounts_tours_tour_id_foreign')
                ->references('id')->on('tours')
                ->onUpdate('cascade')
                ->onUpdate('cascade');

            $table->foreign('discount_id', 'discounts_tours_discount_id_foreign')
                ->references('id')->on('discounts')
                ->onDelete('SET NULL')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tours_discounts', function (Blueprint $table) {
            $table->dropColumn([
                'id',
                'type_id',
                'title',
                'admin_title',
                'type',
                'duration',
                'category',
                'price',
                'start_date',
                'end_date',
                'currency',
                'age_limit',
                'age_start',
                'age_end',
            ]);
        });
    }
}
