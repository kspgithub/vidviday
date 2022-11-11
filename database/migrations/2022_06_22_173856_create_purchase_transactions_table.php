<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('purchase_transactions', function (Blueprint $table) {
            $table->id();
            $table->morphs('model');
            $table->string('merchantAccount')->nullable();
            $table->string('orderReference')->nullable();
            $table->string('merchantSignature')->nullable();
            $table->string('amount')->nullable();
            $table->string('currency')->nullable();
            $table->string('authCode')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('createdDate')->nullable();
            $table->string('processingDate')->nullable();
            $table->string('cardPan')->nullable();
            $table->string('cardType')->nullable();
            $table->string('issuerBankCountry')->nullable();
            $table->string('issuerBankName')->nullable();
            $table->string('recToken')->nullable();
            $table->string('transactionStatus')->nullable();
            $table->string('reason')->nullable();
            $table->string('reasonCode')->nullable();
            $table->string('fee')->nullable();
            $table->string('paymentSystem')->nullable();
            $table->string('repayUrl')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('purchase_transactions');
    }
};
