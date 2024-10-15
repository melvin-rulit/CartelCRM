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
            'firstName' => 'required',
            'middleName' => 'required',
            'lastName' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'telegram_login' => 'required',
        ];
    }

    public function getFirstName(): string
    {
        return $this->input('firstName');
    }

    public function getMiddleName(): string
    {
        return $this->input('middleName');
    }

    public function getLastName(): string
    {
        return $this->input('lastName');
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
