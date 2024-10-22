<?php

namespace App\Http\Requests\Providers;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProvideRequest extends FormRequest
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
            'first_name' => '',
            'middle_name' => '',
            'last_name' => '',
            'phone' => '',
            'city' => '',
            'telegram' => '',
        ];
    }

    public function getFirstName(): ?string
    {
        return $this->input('first_name') ?? null;
    }

    public function getMiddleName(): ?string
    {
        return $this->input('middle_name') ?? null;
    }

    public function getLastName(): ?string
    {
        return $this->input('last_name') ?? null;
    }

    public function getPhone(): ?string
    {
        return $this->input('phone') ?? null;
    }

    public function getCity(): ?string
    {
        return $this->input('city') ?? null;
    }

    public function getTelegramLogin(): ?string
    {
        return $this->input('telegram') ?? null;
    }
}
