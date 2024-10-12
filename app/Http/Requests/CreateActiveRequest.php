<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CreateActiveRequest extends FormRequest
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
            'model'          => 'required',
            'bodyNumber'     => 'required',
            'regNumber'      => 'required',
            'year'           => 'required',
            'colorId'        => 'required',
            'cost'           => 'required',
            'costOfRent'     => 'required',
            'costOfBuyout'   => 'required',
            'investorId'     => 'required',
            'branchId'       => '',
            'osago'          => 'required',
            'osagoNumber'    => 'required',
            'documentSeries' => 'required',
            'documentNumber' => 'required',
            'documentNotes'  => 'required',
            'documentDate'   => 'required'
        ];
    }

    public function getModel(): string
    {
        return $this->input('model');
    }

    public function getBodyNumber(): string
    {
        return $this->input('bodyNumber');
    }

    public function getRegNumber(): string
    {
        return $this->input('regNumber');
    }

    public function getYear(): int
    {
        return $this->input('year');
    }

    public function getColorId(): int
    {
        return $this->input('colorId');
    }

    public function getCost(): float
    {
        return $this->input('cost');
    }

    public function getCostOfRent(): float
    {
        return $this->input('costOfRent');
    }

    public function getCostOfBuyout(): float
    {
        return $this->input('costOfBuyout');
    }

    public function getInvestorId(): int
    {
        return $this->input('investorId');
    }

    public function getBranchId(): int
    {
        if (auth()->user()->isAdmin()) {
            return $this->input('branchId');
        }

        return auth()->user()->getBranchId();
    }

    public function getOsago(): string
    {
        return $this->input('osago');
    }

    public function getOsagoNumber(): string
    {
        return $this->input('osagoNumber');
    }

    public function getDocumentSeries(): string
    {
        return $this->input('documentSeries');
    }

    public function getDocumentNumber(): string
    {
        return $this->input('documentNumber');
    }

    public function getDocumentDate(): string
    {
        return Carbon::parse($this->input('documentDate'));
    }

    public function getDocumentNotes(): string
    {
        return $this->input('documentNotes');
    }
}
