<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends ApiFormRequest
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
            'deadline_date' => ['required', 'string'],
            'description' => ['string'],
            'priority' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => ['code'=>1008, 'message'=>'Не передано обязательное поле (название задачи)'],
            'name.string' => ['code'=>1008, 'message'=>'Не передано обязательное поле (название задачи)'],
            'deadline_date.string' => ['code'=>1009, 'message'=>'Не передано обязательное поле (дедлайн)'],
            'deadline_date.required' => ['code'=>1009, 'message'=>'Не передано обязательное поле (дедлайн)'],
            'description.string' => ['code'=>3000, 'message'=>'Не правильный тип поля'],
            'priority.required' => ['code'=>1012, 'message'=>'Некорректное значение поля (приоритет)'],
            'priority.string' => ['code'=>1012, 'message'=>'Некорректное значение поля (приоритет)'],
        ];
    }
}
