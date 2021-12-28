<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends ApiFormRequest
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
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => ['code'=>1004,'message'=>'Не передано обязательное поле (имя)'],
            'name.string' => ['code'=>1004,'message'=>'Не передано обязательное поле (имя)'],
            'surname.required' =>['code'=>1005,'message'=>'Не передано обязательное поле (фамилия)'],
            'surname.string' =>['code'=>1005,'message'=>'Не передано обязательное поле (фамилия)'],
            'email.required' => ['code'=>1006,'message'=>'Не передано обязательное поле (email)'],
            'email.string' => ['code'=>1006,'message'=>'Не передано обязательное поле (email)'],
            'email.email' => ['code'=>1006,'message'=>'Не передано обязательное поле (email)'],
        ];
    }
}
