<?php

namespace App\Http\Requests\Providers;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CreateProviderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'telegram_login' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'Поле должно быть заполнено',
            'middle_name.required' => 'Поле  должно быть заполнено',
            'last_name.required' => 'Поле  должно быть заполнено',
            'phone.required' => 'Поле  должно быть заполнено',
            'city.required' => 'Поле  должно быть заполнено',
            'telegram_login.required' => 'Поле должно быть заполнено',
        ];
    }

    public function getFirstName(): string
    {
        return $this->input('first_name');
    }

    public function getMiddleName(): string
    {
        return $this->input('middle_name');
    }

    public function getLastName(): string
    {
        return $this->input('last_name');
    }

    public function getPhone(): string
    {
        return $this->input('phone');
    }

    public function getCity(): string
    {
        return $this->input('city');
    }

    public function getTelegramLogin(): string
    {
        return $this->input('telegram_login');
    }
}
