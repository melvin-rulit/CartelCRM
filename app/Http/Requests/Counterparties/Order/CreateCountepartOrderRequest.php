<?php

namespace App\Http\Requests\Counterparties\Order;

use Illuminate\Foundation\Http\FormRequest;

class CreateCountepartOrderRequest extends FormRequest
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

        ];
    }

    public function getOrderNumber(): ?string
    {
        return $this->input('order.order_number') ?? null;
    }

    public function getOrderDate(): ?string
    {
        return $this->input('order.order_date') ?? null;
    }
    public function getOrderAdress(): ?string
    {
        return $this->input('order.delivery_address') ?? null;
    }

    public function getOrderStatus(): ?string
    {
        return $this->input('order.status') ?? null;
    }

    public function getManager(): ?string
    {
        return $this->input('order.manager') ?? null;
    }

    public function getCountepartId(): ?string
    {
        return $this->input('order.countepart.id') ?? null;
    }

    public function getOrderSostavs(): array
    {
        return $this->input('order.orderSostavs');
    }
}
