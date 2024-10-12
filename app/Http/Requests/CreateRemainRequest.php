<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateRemainRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'amount'    => 'required',
            'createdAt' => 'required'
        ];
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
