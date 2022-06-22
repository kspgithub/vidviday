<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read string $orderReference
 */
class PurchaseServiceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'merchantAccount' => ['required', 'string'],
            'orderReference' => ['required', 'string'],
            'merchantSignature' => ['required', 'string'],
            'amount' => ['required', 'numeric'],
            'currency' => ['required', 'string'],
            'authCode' => ['nullable', 'string'],
            'email' => ['nullable', 'string'],
            'phone' => ['nullable', 'string'],
            'createdDate' => ['nullable', 'string'],
            'processingDate' => ['nullable', 'string'],
            'cardPan' => ['nullable', 'string'],
            'cardType' => ['nullable', 'string'],
            'issuerBankCountry' => ['nullable', 'string'],
            'issuerBankName' => ['nullable', 'string'],
            'recToken' => ['nullable', 'string'],
            'transactionStatus' => ['required', 'string'],
            'reason' => ['nullable', 'string'],
            'reasonCode' => ['nullable', 'string'],
            'fee' => ['nullable', 'string'],
            'paymentSystem' => ['nullable', 'string'],
            'repayUrl' => ['nullable', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
