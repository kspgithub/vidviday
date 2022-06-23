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
    const ORDER_REFUNDED = 'Refunded';

    const ORDER_VOIDED = 'Voided';
    const ORDER_IN_PROCESSING = 'InProcessing';
    const ORDER_PENDING = 'Pending';
    const ORDER_EXPIRED = 'Expired';
    const ORDER_DECLINED = 'Declined';
    const ORDER_REFUND_IN_PROCESS = 'RefundInProcessing';

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


    public function notRefunded()
    {
        return $this->transactionStatus !== self::ORDER_REFUNDED && $this->transactionStatus !== self::ORDER_REFUND_IN_PROCESS;
    }
}
