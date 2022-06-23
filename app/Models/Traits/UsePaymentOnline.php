<?php

namespace App\Models\Traits;

use App\Models\PurchaseTransaction;
use Illuminate\Support\Carbon;

trait UsePaymentOnline
{
    public function paymentOnline(PurchaseTransaction $transaction, array $data = [])
    {
        $amount = (int)$data['amount'];
        if ($transaction->notApproved()) {

            $this->payment_online += $amount;
            $this->payment_status = self::PAYMENT_COMPLETE;
            $payment_data = empty($this->payment_data) ? [] : $this->payment_data;
            $payment_data[] = [
                'sum' => $amount,
                'currency' => $data['currency'],
                'date' => Carbon::now()->format('d.m.Y'),
                'type' => 'Онлайн оплата',
                'comment' => null,
                'recipient' => $data['merchantAccount'],
            ];
            $this->payment_data = $payment_data;
            $this->save();
        } elseif ($data['transactionStatus'] === PurchaseTransaction::ORDER_REFUNDED) {
            $amount = -$amount;
            $this->payment_online -= $data['amount'];
            $this->payment_status = self::PAYMENT_RETURNED;
            $payment_data = empty($this->payment_data) ? [] : $this->payment_data;
            $payment_data[] = [
                'sum' => $amount,
                'currency' => $data['currency'],
                'date' => Carbon::now()->format('d.m.Y'),
                'type' => 'Повернення платежу',
                'comment' => null,
                'recipient' => $data['merchantAccount'],
            ];
            $this->payment_data = $payment_data;
            $this->save();
        }

        $transaction->fill($data);
        $transaction->save();

        $this->transactions()->where('transactionStatus', 'New')->forceDelete();
    }

}
