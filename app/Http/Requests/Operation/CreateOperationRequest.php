<?php

namespace App\Http\Requests\Operation;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CreateOperationRequest extends FormRequest
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
            'activeId' => 'required',
            'date'     => 'required',
            'name'     => 'required',
            'type'     => 'required',
            'amount'   => 'required',
        ];
    }

    public function getActiveId(): int
    {
        return $this->input('activeId');
    }

    public function getName(): string
    {
        return $this->input('name');
    }

    public function getDate(): Carbon
    {
        return Carbon::parse($this->input('date'));
    }

    public function getType(): int
    {
        return $this->input('type');
    }

    public function getAmount(): float
    {
        return $this->input('amount');
    }
}
