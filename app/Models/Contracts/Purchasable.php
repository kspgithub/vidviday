<?php

namespace App\Models\Contracts;

use App\Lib\WayForPay\PurchaseAbstract;
use App\Models\PurchaseTransaction;
use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Purchasable
{
    public function getTitleAttribute(): string;

    public function getTotalPriceAttribute(): int;

    public function paymentOnline(PurchaseTransaction $transaction);

    public function purchaseWizard(): PurchaseAbstract;

    public function transactions();
}
