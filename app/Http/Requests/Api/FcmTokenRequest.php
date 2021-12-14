<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class FcmTokenRequest extends ApiFormRequest
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
            'fcm_token' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'fcm_token.required' => ['code'=>1018,'message'=>'Не передано обязательное поле (FCM токен)'],
            'fcm_token.string' => ['code'=>1018,'message'=>'Не передано обязательное поле (FCM токен)'],
        ];
    }
}
