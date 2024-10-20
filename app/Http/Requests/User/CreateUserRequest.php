<?php

namespace App\Http\Requests\User;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'firstName'           => '',
            'middleName'          => '',
            'lastName'            => '',
            'birthday'            => '',
            'email'               => 'required|email|unique:users',
            'password'            => 'required|min:6',

            'passportGive'      => '',
            'passportSeries'      => '',
            'passportNumber'      => '',
            'passportIssuedBy'      => '',
            'passportIssuedByData'      => '',
            'registrationAddress' => '',
            'liveAddress' => '',
            'phoneNumber'         => '',
            'telegram'         => '',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'               => 'Поле "Email" должно быть заполнено',
            'email.email'                  => 'Поле "Email" должно быть адресом электронной почты',
            'email.unique'                 => 'Поле "Email" должно быть уникальным',
            'password.required'            => 'Поле "Пароль" должно быть заполнено',
            'password.min'                 => 'Поле "Пароль" должно быть не короче 6 символов',
            'firstName.required'           => 'Поле "Имя пользователя" должно быть заполнено',
            'lastName.required'            => 'Поле "Фамилия пользователя" должно быть заполнено',
            'birthday.required'            => 'Поле "Дата роджения" должно быть заполнено',
            'passportSeries.required'      => 'Поле "Серия паспорта" должно быть заполнено',
            'passportNumber.required'      => 'Поле "Номер паспорта" должно быть заполнено',
            'passportNotes.required'       => 'Поле "Кем выдан паспорт" должно быть заполнено',
            'phoneNumber.required'         => 'Поле "Номер телефона" должно быть заполнено',
            'registrationAddress.required' => 'Поле "Адрес регистрации" должно быть заполнено',
        ];
    }

    public function getFirstName(): ?string
    {
        return $this->input('firstName') ?? null;
    }

    public function getMiddleName(): ?string
    {
        return $this->input('middleName') ?? null;
    }

    public function getLastName(): ?string
    {
        return $this->input('lastName') ?? null;
    }

    public function getBirthday(): ?string
    {
        return $this->input('birthday') ?? null;
    }

    public function getEmail(): string
    {
        return $this->input('email');
    }

    public function getPassword(): string
    {
        return $this->input('password');
    }

//    public function getRoleId(): int
//    {
//        return $this->input('roleId');
//    }

//    public function isEnabled(): bool
//    {
//        return (bool)$this->input('enabled');
//    }

    public function getPassportGive(): ?string
    {
        return $this->input('passportGive') ?? null;
    }
    public function getPassportSeries(): ?string
    {
        return $this->input('passportSeries') ?? null;
    }
    public function getPassportNumber(): ?string
    {
        return $this->input('passportNumber') ?? null;
    }
    public function getPassportIssuedBy(): ?string
    {
        return $this->input('passportIssuedBy') ?? null;
    }

    public function getPassportIssuedByData(): ?string
    {
        return $this->input('passportIssuedByData') ?? null;
    }

    public function getRegistrationAddress(): ?string
    {
        return $this->input('registrationAddress') ?? null;
    }

    public function getLiveAddress(): ?string
    {
        return $this->input('LiveAddress') ?? null;
    }

    public function getPhone(): ?string
    {
        return preg_replace('|\D|Ui', '', $this->input('phoneNumber')) ?? null;
    }
    public function getTelegram(): ?string
    {
        return preg_replace('|\D|Ui', '', $this->input('telegram')) ?? null;
    }
}
