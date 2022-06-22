<?php

namespace App\Models;

use App\Lib\WayForPay\TransactionHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseTransaction extends Model
{
    const ORDER_APPROVED = 'Approved';
    const ORDER_HOLD_APPROVED = 'WaitingAuthComplete';

    use SoftDeletes;

    protected $fillable = [
        'merchantAccount',
        'orderReference',
        'merchantSignature',
        'amount',
        'currency',
        'authCode',
        'email',
        'phone',
        'createdDate',
        'processingDate',
        'cardPan',
        'cardType',
        'issuerBankCountry',
        'issuerBankName',
        'recToken',
        'transactionStatus',
        'reason',
        'reasonCode',
        'fee',
        'paymentSystem',
        'repayUrl',
    ];

    protected $casts = [
        'amount' => 'integer'
    ];

    /**
     * @return MorphTo|Order|OrderCertificate
     */
    public function order()
    {
        return $this->morphTo('model');
    }


    public function notApproved()
    {
        return $this->transactionStatus !== self::ORDER_APPROVED && $this->transactionStatus !== self::ORDER_HOLD_APPROVED;
    }
}
