<?php

namespace App\Http\Requests\Admin\AdminUser;

use App\Rules\CurrentPasswordCheckRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

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
            'password1' => ['required', 'min:6|required_with:password_confirmation1|same:password_confirmation'],
            'password_confirmation1' => ['required', 'min:6', 'same:password1'],
            'email' => ['required', 'unique:admins,email'],
        ];
    }
    public function messages()
    {
        return [
            'phone_number.required' => 'Обязательное поле',
            'phone_number.unique' => 'Такой телефон уже зарегистрирован',
            'name.required' => 'Обязательное поле',
            'surname.required' => 'Обязательное поле',
            'email.required' => 'Обязательное поле',
            'password1.confirmed' => 'Пароли не совпадают',
            'password1.min' => 'Пароль должен быть минимум 6 символов',
            'password_confirmation1.min' => 'Пароль должен быть минимум 6 символов',
            'password_confirmation1.confirmed' => 'Пароли не совпадают',
            'password_confirmation1.same' => 'Пароли не совпадают',
            'password1.required' => 'Обязательное поле',
            'password_confirmation1.required' => 'Обязательное поле',
            'email.unique' => 'Такой емейл уже зарегистрирован',
        ];
    }
}
