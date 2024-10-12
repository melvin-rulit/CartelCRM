<?php

namespace App\Http\Requests\Deal;

use Illuminate\Foundation\Http\FormRequest;

class CreateDealRecordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'operationId' => 'required|numeric',
            'amount'      => 'required|numeric',
            'comment'     => '',
        ];
    }

    public function getOperationId(): int
    {
        return $this->input('operationId');
    }

    public function getAmount(): float
    {
        return $this->input('amount');
    }

    public function getComment(): ?string
    {
        return $this->input('comment');
    }
}
