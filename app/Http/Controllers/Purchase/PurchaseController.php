<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseServiceRequest;
use App\Lib\WayForPay\TransactionHelper;
use App\Models\PurchaseTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class PurchaseController extends Controller
{
    public function service(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $transaction = PurchaseTransaction::where('orderReference', 'LIKE', $data['orderReference'] ?? 'TEST')->first();
        if (!empty($transaction)) {

            try {
                $helper = new TransactionHelper($data);
                $valid = $helper->isPaymentValid();

                if ($valid === true) {
                    $order = $transaction->order;
                    $order->paymentOnline($transaction, $data);
                    Log::info('WFP RESULT ' . $data['orderReference'] . ' SUCCESS');
                    return $helper->getSuccessResponse();
                }
                $responseMessage = 'WFP RESULT ' . $data['orderReference'] . ' ' . $valid;
            } catch (\Exception $e) {
                $responseMessage = 'WFP EXCEPTION ' . $data['orderReference'] . ' ' . $e->getMessage();
            }
        } else {
            $responseMessage = 'WFP ERROR Transaction not found ' . ($data['orderReference'] ?? '');

        }
        Log::info('PurchaseServiceRequest: ' . $request->getContent());
        Log::error($responseMessage);
        return $responseMessage;
    }


    public function check(Request $request)
    {

    }
}
