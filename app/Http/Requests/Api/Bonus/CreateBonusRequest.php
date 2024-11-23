<?php

namespace App\Http\Requests\Api\Bonus;

use Illuminate\Foundation\Http\FormRequest;

class CreateBonusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:64',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
        ];
    }
    public function messages(): array {
        return [
            'title.required' => 'Заголовок бонуса не должен быть пустым',
            'title.max' => 'Заголовок бонуса должен содержать максимум 64 символа',

            'description.required' => 'Описание бонуса не должен быть пустым',

            'price.required' => 'Описание бонуса не должен быть пустым',
            'price.numeric' => 'Цена бонуса должна быть числом',
            'price.min' => 'Вознаграждение от бонуса не должно быть 0',
        ];
    }
}
