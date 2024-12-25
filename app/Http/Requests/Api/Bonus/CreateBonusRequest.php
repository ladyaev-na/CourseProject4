<?php

namespace App\Http\Requests\Api\Bonus;

use App\Http\Requests\Api\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreateBonusRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:64',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'role_id' => 'required|integer|exists:roles,id',
        ];
    }
    public function messages(): array {
        return [
            'title.required' => 'Заголовок бонуса не должен быть пустым',
            'title.max' => 'Заголовок бонуса должен содержать максимум 64 символа',

            'description.required' => 'Описание бонуса не должен быть пустым',

            'price.required' => 'Цена бонуса не должна быть пустой',
            'price.numeric' => 'Цена бонуса должна быть числом',
            'price.min' => 'Вознаграждение от бонуса не должно быть 0',

            'role_id' => 'Роль должна быть выбрана'
        ];
    }
}
