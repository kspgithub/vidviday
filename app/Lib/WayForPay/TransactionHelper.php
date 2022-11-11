<?php

namespace App\Lib\WayForPay;

use App\Models\PurchaseTransaction;
use WayForPay\SDK\Credential\AccountSecretCredential;

class TransactionHelper
{
    const SIGNATURE_SEPARATOR = ';';

    protected $data;

    protected $response;

    public function __construct(array $data = null)
    {
        $this->data = $data;
    }

    protected function getCredential()
    {
        return new AccountSecretCredential(config('services.wayforpay.login'), config('services.wayforpay.secret'));
    }

    public function getSecretKey()
    {
        return $this->getCredential()->getSecret();
    }

    protected $keysForResponseSignature = [
        'merchantAccount',
        'orderReference',
        'amount',
        'currency',
        'authCode',
        'cardPan',
        'transactionStatus',
        'reasonCode',
    ];

    /**
 * @var array
*/
    protected $keysForSignature = [
        'merchantAccount',
        'merchantDomainName',
        'orderReference',
        'orderDate',
        'amount',
        'currency',
        'productName',
        'productCount',
        'productPrice',
    ];

    /**
     * @param $option
     * @param $keys
     *
     * @return string
     */
    public function getSignature($option, $keys)
    {
        $hash = [];
        foreach ($keys as $dataKey) {
            if (! isset($option[$dataKey])) {
                $hash[] = '';

                continue;
            }
            if (is_array($option[$dataKey])) {
                foreach ($option[$dataKey] as $v) {
                    $hash[] = $v;
                }
            } else {
                $hash[] = $option[$dataKey];
            }
        }

        $hash = implode(self::SIGNATURE_SEPARATOR, $hash);

        return hash_hmac('md5', $hash, $this->getSecretKey());
    }

    /**
     * @param $options
     *
     * @return string
     */
    public function getRequestSignature($options)
    {
        return $this->getSignature($options, $this->keysForSignature);
    }

    /**
     * @param $options
     *
     * @return string
     */
    public function getResponseSignature($options)
    {
        return $this->getSignature($options, $this->keysForResponseSignature);
    }

    public function isPaymentValid()
    {
        $response = $this->data;

        if (! isset($response['merchantSignature']) && isset($response['reason'])) {
            return $response['reason'];
        }

        $sign = $this->getResponseSignature($response);

        if (isset($response['merchantSignature']) && $sign != $response['merchantSignature']) {
            return 'Invalid Signature';
        }

        if ($response['transactionStatus'] == PurchaseTransaction::ORDER_APPROVED ||
            $response['transactionStatus'] == PurchaseTransaction::ORDER_HOLD_APPROVED ||
            $response['transactionStatus'] == PurchaseTransaction::ORDER_REFUNDED) {
            return true;
        }

        if ($response['transactionStatus'] == 'InProcessing') {
            return 'Transaction in processing';
        }

        if (! empty($response['transactionStatus'])) {
            return $response['transactionStatus'];
        }

        return 'Unknown Error';
    }

    public function getSuccessResponse()
    {
        $time = time();
        $responseToGateway = [
            'orderReference' => $this->data['orderReference'],
            'status' => 'accept',
            'time' => $time,
        ];
        $sign = [];
        foreach ($responseToGateway as $dataKey => $dataValue) {
            $sign[] = $dataValue;
        }
        $sign = implode(self::SIGNATURE_SEPARATOR, $sign);
        $sign = hash_hmac('md5', $sign, $this->getSecretKey());
        $responseToGateway['signature'] = $sign;

        return json_encode($responseToGateway);
    }
}
