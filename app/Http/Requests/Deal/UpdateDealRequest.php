<?php

namespace App\Http\Requests\Deal;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDealRequest extends FormRequest
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
            'type'         => 'required',
            'kind'         => 'required',
            'proxyId'      => '',
            'ownerId'      => '',
            'activeId'     => 'required|numeric',
            'branchId'     => 'required|numeric',
            'clientId'     => 'required|numeric',
            'remain'       => 'required|numeric',
            'costOfBuyout' => 'required|numeric',
            'costOfRent'   => 'required|numeric',
            'initial'      => '',
            'createdAt'    => 'required|date',
            'validUntil'   => 'date|nullable',
            'comment'      => '',
            'citizenship'  => 'required',
            'redemption_period'  => '',

        ];
    }

    public function messages()
    {
        return [
            'type.required'         => 'Поле "Тип сделки" обязательно для заполнения',
            'kind.required'         => 'Поле "Способ оформления сделки" обязательно для заполнения',
            'activeId.required'     => 'Поле "Актив" обязательно для заполнения',
            'branchId.required'     => 'Поле "Филиал" обязательно для заполнения',
            'clientId.required'     => 'Поле "Арендополучатель" обязательно для заполнения',
            'remain.required'       => 'Поле "Сумма основного долга" обязательно для заполнения',
            'costOfBuyout.required' => 'Поле "Стоимость выкупа, неделя" обязательно для заполнения',
            'costOfRent.required'   => 'Поле "Стоимость аренды, неделя" обязательно для заполнения',
            'createdAt.required'    => 'Поле "Дата договора" обязательно для заполнения',
            'costOfBuyout.numeric'  => 'Поле "Стоимость выкупа, неделя" должно быть числом',
            'costOfRent.numeric'    => 'Поле "Стоимость аренды, неделя" должно быть числом',
            'citizenship.required'  => 'Поле "Гражданство" обязательно для заполнения'
        ];
    }

    public function getType(): string
    {
        return $this->input('type');
    }

    public function getKind(): string
    {
        return $this->input('kind');
    }

    public function getProxyId(): ?int
    {
        return $this->input('proxyId');
    }

    public function getOwnerId(): ?int
    {
        return $this->input('ownerId');
    }

    public function getActiveId(): int
    {
        return $this->input('activeId');
    }

    public function getBranchId(): int
    {
        return $this->input('branchId');
    }

    public function getClientId(): int
    {
        return $this->input('clientId');
    }

    public function getCostOfRent(): float
    {
        return $this->input('costOfRent');
    }

    public function getCostOfBuyout(): float
    {
        return $this->input('costOfBuyout');
    }

    public function getInitial(): float
    {
        return $this->input('initial') ?? 0;
    }

    public function getRemain(): float
    {
        return $this->input('remain');
    }

    public function getCreatedAt(): Carbon
    {
        return Carbon::parse($this->input('createdAt'));
    }

    public function getValidUntil(): ?Carbon
    {
        return $this->input('validUntil') ? Carbon::parse($this->input('validUntil')) : null;
    }

    public function getComment(): ?string
    {
        return $this->input('comment');
    }

    public function getCitizenship(): string
    {
        return $this->input('citizenship');
    }

    public function getRedemptionPeriod(): int
    {
        return $this->input('redemption_period');
    }
    public function getSroke(): ?string
    {
        return $this->input('srok');
    }
}
