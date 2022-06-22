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
        $data = $request->all();
        Log::info('PurchaseServiceRequest: ' . json_encode($data));
        $transaction = PurchaseTransaction::where('orderReference', 'LIKE', $request->input('orderReference'))->first();
        if (!empty($transaction)) {
            $transaction->fill($data);
            $transaction->save();

            try {
                $helper = new TransactionHelper($data);
                $valid = $helper->isPaymentValid();

                if ($valid === true) {
                    $order = $transaction->order;
                    $order->paymentOnline($transaction);
                    Log::info('PAYMENT RESULT ' . $request->orderReference . ': SUCCESS');
                    return $helper->getSuccessResponse();
                }
                Log::error('PAYMENT RESULT ' . $request->orderReference . ':' . $valid);
                return $valid;
            } catch (\Exception $e) {
                Log::error('WFP EXCEPTION ' . $request->orderReference . ':' . $e->getMessage());
                return $e->getMessage();
            }
        } else {
            Log::error('Transaction not found: ' . $request->orderReference);
            return 'Transaction not found';
        }
    }
}
