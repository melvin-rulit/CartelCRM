<?php

namespace App\Http\Requests\Operation;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOperationRequest extends FormRequest
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
            'name' => 'required',
            'enabled' => 'required',
            'type' => 'required'
        ];
    }

    public function getName()
    {
        return $this->input('name');
    }

    public function isEnabled()
    {
        return $this->input('enabled');
    }

    public function getType()
    {
        return $this->input('type');
    }
}
