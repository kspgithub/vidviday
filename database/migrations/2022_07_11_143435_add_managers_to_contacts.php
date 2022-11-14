<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->json('managers_corporate')->nullable()->after('lng');
            $table->json('managers_agency')->nullable()->after('managers_corporate');
        });

        $corpIds = \App\Models\Staff::whereHas('types', function ($q) {
            return $q->where('slug', 'corporate-order');
        })->get('id')->pluck('id')->toArray();

        $agencyIds = \App\Models\Staff::whereHas('types', function ($q) {
            return $q->where('slug', 'travel-agencies');
        })->get('id')->pluck('id')->toArray();

        \App\Models\Contact::where('id', 1)->update([
            'managers_corporate' => json_encode($corpIds),
            'managers_agency' => json_encode($agencyIds),
        ]);
    }

    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('managers');
        });
    }
};
