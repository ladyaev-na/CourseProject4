<?php

namespace App\Http\Requests\Api\Bonus;

use App\Http\Requests\Api\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBonusRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'title' => 'string|max:64',
            'description' => 'string',
            'price' => 'numeric|min:0',
            'role_id' => 'integer|exists:roles,id'
        ];
    }
    public function messages(): array {
        return [
            'title.max' => 'Заголовок бонуса должен содержать максимум 64 символа',
            'price.numeric' => 'Цена бонуса должна быть числом',
            'price.min' => 'Вознаграждение от бонуса не должно быть 0',
            'role_id' => 'Роль должна быть выбрана',
        ];
    }
}
