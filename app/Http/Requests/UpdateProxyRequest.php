<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProxyRequest extends FormRequest
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
            'delegate.id'  => 'required',
            'owner.id'     => 'required',
            'number'       => 'required',
            'validUntil'   => 'required',
            'issuedBy'     => 'required',
            'issuedNumber' => 'required',
        ];
    }

    public function getDelegateId(): int
    {
        return $this->input('delegate.id');
    }

    public function getOwnerId(): int
    {
        return $this->input('owner.id');
    }

    public function getNumber(): string
    {
        return $this->input('number');
    }

    public function getValidUntil(): Carbon
    {
        return Carbon::parse($this->input('validUntil'));
    }

    public function getIssuedBy(): string
    {
        return $this->input('issuedBy');
    }

    public function getIssuedNumber(): string
    {
        return $this->input('issuedNumber');
    }
}
