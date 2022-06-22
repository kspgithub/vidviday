<?php

namespace App\Models\Traits;

use App\Models\PurchaseTransaction;

trait UsePaymentOnline
{
    public function paymentOnline(PurchaseTransaction $transaction, array $data = [])
    {
        if ($transaction->notApproved()) {
            $this->payment_online += $transaction->amount;
            $this->payment_status = self::PAYMENT_COMPLETE;
            $this->save();
        }

        $transaction->fill($data);
        $transaction->save();

        $this->transactions()->where('transactionStatus', 'New')->forceDelete();
    }

}
