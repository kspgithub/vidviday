<?php

namespace App\Http\Requests\Admin\User;

use App\Rules\UnusedPassword;
use App\Rules\PasswordRules;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateUserPasswordRequest.
 */
class UpdateUserPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => array_merge(
                [
                    'max:100',
                    new UnusedPassword((int)$this->segment(4)),
                ],
                PasswordRules::changePassword($this->email)
            ),
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
        throw new AuthorizationException(__('Only the administrator can change their password.'));
    }
}
