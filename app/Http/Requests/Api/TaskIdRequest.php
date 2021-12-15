<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class TaskIdRequest extends ApiFormRequest
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
            'task_id' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'task_id.required' => ['code'=>1007, 'message'=>'Задача с указанным ID не найдена'],
        ];
    }
}
