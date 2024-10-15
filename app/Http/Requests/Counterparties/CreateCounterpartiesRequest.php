<?php

namespace App\Http\Requests\Counterparties;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CreateCounterpartiesRequest extends FormRequest
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
            'firstName' => 'required',
            'middleName' => 'required',
            'lastName' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'telegram_login' => 'required',
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

    public function getFirstName(): string
    {
        return $this->input('firstName');
    }

    public function getMiddleName(): string
    {
        return $this->input('middleName');
    }

    public function getLastName(): string
    {
        return $this->input('lastName');
    }

    public function getPhone(): string
    {
        return $this->input('phone');
    }

    public function getCity(): string
    {
        return $this->input('city');
    }

    public function getTelegramLogin(): string
    {
        return $this->input('telegram_login');
    }
}
