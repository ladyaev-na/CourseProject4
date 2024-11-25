<?php

namespace App\Http\Requests\Api\Status;

use App\Http\Requests\Api\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreateStatusRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:64|unique:statuses,name',
            'code' => 'required|string|max:64|unique:statuses,code',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Поле "Название" обязательно для заполнения.',
            'name.max' => 'Поле "Название" не должно превышать 64 символа.',
            'name.unique' => 'Такое "Название" уже существует.',

            'code.required' => 'Поле "Код" обязательно для заполнения.',
            'code.max' => 'Поле "Код" не должно превышать 64 символа.',
            'code.unique' => 'Такой "Код" уже существует.',
        ];
    }
}
