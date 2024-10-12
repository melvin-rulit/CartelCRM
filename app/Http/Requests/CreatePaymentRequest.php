<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CreatePaymentRequest extends FormRequest
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
            'date'   => 'required',
            'rent'   => 'required',
            'buyout' => 'required',
        ];
    }

    public function getRent(): float
    {
        return $this->input('rent');
    }

    public function getBuyout(): float
    {
        return $this->input('buyout');
    }

    public function getDate(): Carbon
    {
        return Carbon::parse($this->input('date'));
    }

    public function getDealId(): int
    {
        return $this->input('dealId');
    }
}
