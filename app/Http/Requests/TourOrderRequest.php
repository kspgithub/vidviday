<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\RequestDefaultValuesTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TourOrderRequest extends FormRequest
{
    use RequestDefaultValuesTrait;

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
            'viber' => ['nullable'],
            'email' => ['nullable'],
            'company' => ['nullable'],
            'group_type' => ['nullable', Rule::in(['0', '1'])],
            'tour_id' => ['nullable', 'integer'],
            'schedule_id' => ['nullable', 'integer'],
            'places' => ['required', 'integer'],
            'children' => ['nullable', Rule::in(['0', '1'])],
            'children_young' => ['nullable', 'integer'],
            'children_older' => ['nullable', 'integer'],
            'without_place' => ['nullable', Rule::in(['0', '1'])],
            'without_place_count' => ['nullable', 'integer', Rule::requiredIf((int)$this->without_place === 1)],
            'additional' => ['nullable', Rule::in(['0', '1'])],
            'program_type' => ['nullable', Rule::in(['0', '1'])],
            'participants' => ['nullable', 'array'],
            'participant_contacts' => ['nullable', 'array'],
            'accommodation' => ['nullable', 'array'],

            'payment_type' => ['required_if:group_type,==,1', 'integer'],
            'confirmation_type' => ['nullable', 'integer'],
            'confirmation_email' => (int)$this->confirmation_type === 1 ? ['required', 'email'] : ['nullable'],
            'confirmation_viber' => [Rule::requiredIf((int)$this->confirmation_type === 2)],
            'confirmation_phone' => [Rule::requiredIf((int)$this->confirmation_type === 3)],
            'act_is_needed' => ['nullable', Rule::in(['0', '1'])],
            'comment' => ['nullable', 'string'],
            'tour_plan' => ['nullable', 'string'],
            'start_date' => ['nullable', 'string'],
            'start_place' => ['nullable', 'string'],
            'end_date' => ['nullable', 'string'],
            'end_place' => ['nullable', 'string'],
            'group_comment' => ['nullable', 'string'],
            'program_comment' => ['nullable', 'string'],
            'price_include' => ['nullable', 'array'],
            'conditions' => ['required', Rule::in(['1'])],
            'is_tourist' => ['nullable'],
            'offer_date' => ['nullable'],
        ];
    }

    protected function defaults()
    {
        return [
            'without_place_count' => 0,
        ];
    }
}
