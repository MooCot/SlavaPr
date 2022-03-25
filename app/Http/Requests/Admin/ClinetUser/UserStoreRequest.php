<?php

namespace App\Http\Requests\Admin\ClinetUser;

use App\Rules\CurrentPasswordCheckRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserStoreRequest extends FormRequest
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
            'access' => ['required'],
            'role' => ['required'],
            'email' => ['required', 'unique:users,email'],
            'phone_number' => ['min:14', 'required', 'unique:users,phone_number'],
            'password1' => ['required', 'min:6|required_with:password_confirmation1|same:password_confirmation'],
            'password_confirmation1' => ['required', 'min:6', 'same:password1'],
        ];
    }
    
    public function messages()
    {
        return [
            'phone_number.required' => 'Не передано обязательное поле',
            'phone_number.unique' => 'Такой телефон уже зарегистрирован',
            'name.required' => 'Не передано обязательное поле',
            'access.required' => 'Не передано обязательное поле',
            'role.required' => 'Не передано обязательное поле',
            'surname.required' => 'Не передано обязательное поле',
            'password1.required' => 'Не передано обязательное поле',
            'password_confirmation1.required' => 'Не передано обязательное поле',
            'email.required' => 'Не передано обязательное поле',
            'password1.confirmed' => 'Пароли не совпадают',
            'password1.min' => 'Пароль должен быть минимум 6 символов',
            'password_confirmation1.min' => 'Пароль должен быть минимум 6 символов',
            'password_confirmation1.confirmed' => 'Пароли не совпадают',
            'password_confirmation1.same' => 'Пароли не совпадают',
            'email.unique' => 'Такой емейл уже зарегистрирован',
        ];
    }
}
