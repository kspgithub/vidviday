<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

/**
 * @property-read string $orderReference
 */
class PurchaseServiceRequest extends FormRequest
{
//    protected function prepareForValidation()
//    {
//        $data = json_decode($this->getContent(), true);
//
//        $this->merge($data);
//    }

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
            'createdDate' => ['nullable', 'numeric'],
            'processingDate' => ['nullable', 'numeric'],
            'cardPan' => ['nullable', 'string'],
            'cardType' => ['nullable', 'string'],
            'issuerBankCountry' => ['nullable', 'string'],
            'issuerBankName' => ['nullable', 'string'],
            'recToken' => ['nullable', 'string'],
            'transactionStatus' => ['required', 'string'],
            'reason' => ['nullable', 'string'],
            'reasonCode' => ['nullable', 'numeric'],
            'fee' => ['nullable', 'numeric'],
            'paymentSystem' => ['nullable', 'string'],
            'repayUrl' => ['nullable', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'status' => 400,
            'errors' => $validator->errors(), //$validator->errors()
        ]);

        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
