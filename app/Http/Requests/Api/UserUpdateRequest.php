<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => 'string|max:64|min:3',
            'surname' => 'string|max:64|min:3',
            'patronymic' => 'nullable|string|max:64|min:3',
            'login' => 'string|max:64|unique:users,login,' . $this->route('id'),
            'password' => 'string|max:64|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            'fine_id' => 'integer|exists:fines,id',
            'status_id' => 'integer|exists:statuses,id',
        ];
    }
    public function messages(): array{
        return [
            'name.max' => 'Поле "Имя" не должно превышать 64 символа.',
            'name.min' => 'Поле "Имя" не должно быть меньше 3 символов.',

            'surname.max' => 'Поле "Фамилия" не должно превышать 64 символа.',
            'surname.min' => 'Поле "Фамилия" не должно быть меньше 3 символов.',

            'patronymic.max' => 'Поле "Отчество" не должно превышать 64 символа.',
            'patronymic.min' => 'Поле "Отчество" не должно быть меньше 3 символов.',

            'login.max' => 'Поле "Логин" не должно превышать 64 символа.',
            'login.unique' => 'Такой "Логин" уже существует.',

            'password.max' => 'Поле "Пароль" не должно превышать 64 символа.',
            'password.regex' => 'Пароль должен содержать как минимум одну заглавную букву, одну строчную букву, одну цифру и один специальный символ (@$!%*?&).',


        ];
    }
}
