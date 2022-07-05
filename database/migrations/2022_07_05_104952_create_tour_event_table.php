<?php

use App\Models\EventItem;
use App\Models\Tour;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_event', function (Blueprint $table) {
            $table->foreignIdFor(Tour::class);
            $table->foreignIdFor(EventItem::class);

            $table->primary(['tour_id', 'event_item_id']);

            $table->foreign('tour_id')->references('id')->on('tours')->cascadeOnDelete();
            $table->foreign('event_item_id')->references('id')->on('event_items')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tour_event');
    }
}
