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
            'password' => ['required', Password::min(6), 'confirmed'],
            'password_confirmation' => ['required', 'min:6'],
            'email' => ['required', 'unique:admins,email'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Не передано обязательное поле',
            'surname.required' => 'Не передано обязательное поле',
            'password.required' => 'Не передано обязательное поле',
            'password_confirmation.required' => 'Не передано обязательное поле',
            'email.required' => 'Не передано обязательное поле',
            'password.confirmed' => 'Пароли не совпадают',
            'password.min' => 'Пароль должен быть минимум 6 символов',
            'email.confirmed' => 'Такой емейл уже зарегистрирован',
        ];
    }
}
