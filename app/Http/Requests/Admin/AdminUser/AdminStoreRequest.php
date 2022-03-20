<?php

namespace App\Http\Requests\Admin\AdminUser;

use App\Rules\CurrentPasswordCheckRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class AdminStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'surname' => ['required'],
            'password' => ['required', Password::min(6)->numbers(), 'confirmed'],
            'password_confirmation' => ['required', 'min:6'],
            'email' => ['required'],
        ];
    }
}
