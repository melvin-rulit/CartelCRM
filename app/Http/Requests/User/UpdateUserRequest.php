<?php

namespace App\Http\Requests\User;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'first_name'           => '',
            'middle_name'          => '',
            'last_name'            => '',
            'birthday'            => '',

            'passport_give'      => '',
            'passport_series'      => '',
            'passport_number'      => '',
            'passport_issuedBy'      => '',
            'passport_issuedByDate'      => '',
            'registration_address' => '',
            'live_adress' => '',
            'phone_number'         => '',
            'telegram'         => '',
            'comment'             => ''
        ];
    }

//    public function messages(): array
//    {
//        return [
//            'email.required'               => 'Поле "Email" должно быть заполнено',
//            'email.email'                  => 'Поле "Email" должно быть адресом электронной почты',
//            'email.unique'                 => 'Поле "Email" должно быть уникальным',
//            'password.required'            => 'Поле "Пароль" должно быть заполнено',
//            'password.min'                 => 'Поле "Пароль" должно быть не короче 6 символов',
//            'firstName.required'           => 'Поле "Имя пользователя" должно быть заполнено',
//            'lastName.required'            => 'Поле "Фамилия пользователя" должно быть заполнено',
//            'birthday.required'            => 'Поле "Дата роджения" должно быть заполнено',
//            'passportSeries.required'      => 'Поле "Серия паспорта" должно быть заполнено',
//            'passportNumber.required'      => 'Поле "Номер паспорта" должно быть заполнено',
//            'passportNotes.required'       => 'Поле "Кем выдан паспорт" должно быть заполнено',
//            'phoneNumber.required'         => 'Поле "Номер телефона" должно быть заполнено',
//            'registrationAddress.required' => 'Поле "Адрес регистрации" должно быть заполнено',
//        ];
//    }

    public function getFirstName(): ?string
    {
        return $this->input('first_name') ?? null;
    }

    public function getMiddleName(): ?string
    {
        return $this->input('middle_name') ?? null;
    }

    public function getLastName(): ?string
    {
        return $this->input('last_name') ?? null;
    }

    public function getBirthday(): ?string
    {
        return $this->input('birthday') ?? null;
    }

    public function getEmail(): ?string
    {
        return $this->input('email') ?? null;
    }

    public function getPassword(): ?string
    {
        return $this->input('password') ?? null;
    }

    public function getPassportGive(): ?string
    {
        return $this->input('passport_give') ?? null;
    }
    public function getPassportSeries(): ?string
    {
        return $this->input('passport_series') ?? null;
    }
    public function getPassportNumber(): ?string
    {
        return $this->input('passport_number') ?? null;
    }
    public function getPassportIssuedBy(): ?string
    {
        return $this->input('passport_issuedBy') ?? null;
    }

    public function getPassportIssuedByData(): ?string
    {
        return $this->input('passport_issuedByDate') ?? null;
    }

    public function getRegistrationAddress(): ?string
    {
        return $this->input('registration_address') ?? null;
    }

    public function getLiveAddress(): ?string
    {
        return $this->input('live_adress') ?? null;
    }

    public function getPhone(): ?string
    {
        return preg_replace('|\D|Ui', '', $this->input('phone_number')) ?? null;
    }
    public function getTelegram(): ?string
    {
//        return preg_replace('|\D|Ui', '', $this->input('telegram')) ?? null;
        return $this->input('telegram') ?? null;
    }
}
