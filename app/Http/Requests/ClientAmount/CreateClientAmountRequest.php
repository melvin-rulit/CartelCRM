<?php

namespace App\Http\Requests\ClientAmount;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CreateClientAmountRequest extends FormRequest
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
            'clientId'  => 'required',
            'amount'    => 'required|numeric',
            'createdAt' => 'required',
        ];
    }

    public function getClientId(): int
    {
        return $this->input('clientId');
    }

    public function getAmount(): float
    {
        return $this->input('amount');
    }

    public function getCreatedAt(): Carbon
    {
        return Carbon::parse($this->input('createdAt'));
    }
}
