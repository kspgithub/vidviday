<?php

namespace App\Http\Requests\Admin\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\PasswordRules;

/**
 * Class StoreUserRequest.
 */
class StoreUserRequest extends FormRequest
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
            'email' => ['required', 'max:255', 'email', Rule::unique('users')],

            'first_name' => ['string', 'max:100', 'nullable'],
            'last_name' => ['string', 'max:100', 'nullable'],
            'middle_name' => ['string', 'max:100', 'nullable'],
            'mobile_phone' => ['max:100', 'phone:AUTO', 'nullable'],
            'work_phone' => ['max:100', 'phone:AUTO', 'nullable'],
            'birthday' => ['date', 'nullable'],
            'avatar' => ['string', 'max:255', 'nullable'],
            'viber' => ['string', 'max:255', 'nullable'],
            'company' => ['string', 'max:255', 'nullable'],
            'address' => ['string', 'max:255', 'nullable'],
            'position' => ['string', 'max:255', 'nullable'],
            'work_email' => ['email', 'max:255', 'nullable'],
            'website' => ['url', 'nullable'],
            'avatar_upload' => ['mimes:jpg,png'],
            'password' => ['max:100', PasswordRules::register($this->email)],
            'status' => ['required', Rule::in([User::STATUS_ACTIVE, User::STATUS_ACTIVE])],
            'email_verified' => ['integer', 'nullable'],
            'send_confirmation_email' => ['integer', 'nullable'],
            'role' => ['required', Rule::exists('roles', 'name')],
//            'roles' => ['sometimes', 'array'],
//            'roles.*' => [Rule::exists('roles', 'id')->whereIn('name', $this->roles)],
//            'permissions' => ['sometimes', 'array'],
//            'permissions.*' => [Rule::exists('permissions', 'id')->where('name', $this->permissions)],
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'role.exists' => __('Role not found or are not allowed to be associated with this user.'),
            'roles.*.exists' =>
                __('One or more roles were not found or are not allowed to be associated with this user type.'),
            'permissions.*.exists' =>
                __('One or more permissions were not found or are not allowed to be associated with this user type.'),
        ];
    }
}
