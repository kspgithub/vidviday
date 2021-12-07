<?php

namespace App\Http\Requests;

use App\Models\OrderCertificate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property string $type
 * @property string $packing
 */
class CertificateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'first_name' => ['required'],
            'last_name' => ['required'],
            'phone' => ['required'],
            'email' => ['required', 'email'],
            'first_name_recipient' => ['required'],
            'last_name_recipient' => ['required'],
            'type' => ['required', Rule::in([OrderCertificate::TYPE_SUM, OrderCertificate::TYPE_TOUR])],
            'design' => ['required', Rule::in([OrderCertificate::DESIGN_CLASSIC, OrderCertificate::DESIGN_HEART])],
            'format' => ['required', Rule::in([OrderCertificate::FORMAT_ELECTRONIC, OrderCertificate::FORMAT_PRINTED])],
            'sum' => ['nullable', 'numeric', 'min:100', Rule::requiredIf($this->type === OrderCertificate::TYPE_SUM)],
            'tour_id' => ['nullable', Rule::requiredIf($this->type === OrderCertificate::TYPE_TOUR)],
            'places' => ['nullable', Rule::requiredIf($this->type === OrderCertificate::TYPE_TOUR)],
            'packing' => ['nullable',  Rule::in(['0','1'])],
            'packing_type' => ['nullable', Rule::requiredIf((int)$this->packing === 1)],
            'payment_type' => ['required', 'numeric'],
            'comment' =>  ['nullable'],
        ];
    }
}
