<?php

namespace App\Http\Requests\Client;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CreateClientRequest extends FormRequest
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
            'firstName'           => 'required',
            'middleName'          => '',
            'lastName'            => 'required',
            'birthday'            => 'required',
            'passportSeries'      => 'required',
            'passportNumber'      => 'required',
            'passportNotes'       => 'required',
            'registrationAddress' => 'required',
            'residenceAddress'    => 'required',
            'phoneNumber'         => 'required|unique:clients,phone_number',
            'email'               => 'required|email',
            'comment'             => '',
            'residentCard'        => '',
            'personnelNumber'     => '',
        ];
    }

    public function getFirstName(): string
    {
        return $this->input('firstName');
    }

    public function getMiddleName(): string
    {
        return $this->input('middleName') ?? '';
    }

    public function getLastName(): string
    {
        return $this->input('lastName');
    }

    public function getBirthday(): Carbon
    {
        return Carbon::parse($this->input('birthday'));
    }

    public function getPassportSeries(): string
    {
        return $this->input('passportSeries');
    }

    public function getPassportNumber(): string
    {
        return $this->input('passportNumber');
    }

    public function getPassportNotes(): string
    {
        return $this->input('passportNotes');
    }

    public function getRegistrationAddress(): string
    {
        return $this->input('registrationAddress');
    }

    public function getResidenceAddress(): string
    {
        return $this->input('residenceAddress');
    }

    public function getPhone(): string
    {
        return preg_replace('|\D|Ui', '', $this->input('phoneNumber'));
    }

    public function getEmail(): string
    {
        return $this->input('email');
    }

    public function getComment(): string
    {
        return $this->input('comment') ?? '';
    }

    public function getResidentCard(): string
    {
        return $this->input('residentCard') ?? '';
    }

    public function getPersonnelNumber(): string
    {
        return $this->input('personnelNumber') ?? '';
    }
}
