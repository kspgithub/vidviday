<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TestimonialAnswerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
//        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Auth::check() ? [
            //
            'parent_id'=>['required', 'integer'],
            'text'=>['required', 'string'],
            'email'=>['nullable'],
            'phone'=>['nullable'],
            'first_name'=>['nullable'],
            'last_name'=>['nullable'],
            'type'=>['nullable'],
        ] : [
            //
            'parent_id'=>['required', 'integer'],
            'text'=>['required', 'string'],
            'email'=>['required'],
            'phone'=>['required'],
            'first_name'=>['required'],
            'last_name'=>['required'],
            'type'=>['nullable'],
        ];
    }
}
