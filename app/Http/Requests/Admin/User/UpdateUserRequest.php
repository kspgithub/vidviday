<?php

namespace App\Http\Requests\Admin\User;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateUserRequest.
 *
 * @property User $user
 */
class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !($this->user->isMasterAdmin() && !$this->user()->isMasterAdmin());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'max:255', 'email', Rule::unique('users')->ignore($this->user->id)],
            'bitrix_id' => ['string', 'max:100', 'nullable'],
            'first_name' => ['string', 'max:100', 'nullable'],
            'last_name' => ['string', 'max:100', 'nullable'],
            'middle_name' => ['string', 'max:100', 'nullable'],
            'mobile_phone' => ['max:100', 'nullable'],
            'work_phone' => ['max:100', 'nullable'],
            'birthday' => ['date', 'nullable'],
            'avatar' => ['string', 'max:255', 'nullable'],
            'viber' => ['string', 'max:255', 'nullable'],
            'company' => ['string', 'max:255', 'nullable'],
            'address' => ['string', 'max:255', 'nullable'],
            'position' => ['string', 'max:255', 'nullable'],
            'work_email' => ['email', 'max:255', 'nullable'],
            'website' => ['url', 'nullable'],
            'avatar_upload' => ['mimes:jpg,png', 'max:500'],
            'role' => ['required', 'max:255'],
//            'roles' => ['sometimes', 'array'],
//            'roles.*' => ['sometimes', 'exists:roles,id'],
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

    /**
     * Handle a failed authorization attempt.
     *
     * @return void
     * @throws AuthorizationException
     *
     */
    protected function failedAuthorization()
    {
        throw new AuthorizationException(__('Only the administrator can update this user.'));
    }
}
