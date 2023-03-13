<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParticipantsContactsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->text('participant_contacts')->nullable()->after('participants');
        });

        $orders =  DB::table('orders')->whereNotNull('participants')->get();

        foreach($orders as $order){
            $item = json_decode($order->participants);
            $participant_contacts = [];
            if (!empty($item->participant_phone)){

                $participant_contacts[] = [
                    "phone" => $item->participant_phone,
                    "comment" => '',
                ];

                $participant_contacts = json_encode($participant_contacts);
                DB::table('orders')->where('id', $order->id)->update(['participant_contacts' => $participant_contacts]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('participant_contacts');
        });
    }
}
