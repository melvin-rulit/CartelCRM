<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSourceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'        => 'required',
            'amount'      => 'required',
            'percent'     => 'required',
            'investor.id' => 'required',
        ];
    }

    public function getName(): string
    {
        return $this->input('name');
    }

    public function getAmount(): float
    {
        return $this->input('amount');
    }

    public function getPercent(): float
    {
        return $this->input('percent');
    }

    public function getInvestorId(): int
    {
        return $this->input('investor.id');
    }
}
