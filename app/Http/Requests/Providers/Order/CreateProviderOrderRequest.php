<?php

namespace App\Http\Requests\Providers\Order;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CreateProviderOrderRequest extends FormRequest
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
//            'order_number' => 'required',
//            'order_date' => 'required',
//            'order_date_in_store' => 'required',
//            'status' => 'required',
//            'manager' => 'required',

//            'order_details' => 'required',
//            'order_price' => 'required',
        ];
    }

//    public function messages(): array
//    {
//        return [
//            'first_name.required' => 'Поле должно быть заполнено',
//            'middle_name.required' => 'Поле  должно быть заполнено',
//            'last_name.required' => 'Поле  должно быть заполнено',
//            'phone.required' => 'Поле  должно быть заполнено',
//            'city.required' => 'Поле  должно быть заполнено',
//            'telegram.required' => 'Поле должно быть заполнено',
//        ];
//    }

    public function getOrderNumber(): ?string
    {
        return $this->input('order.order_number') ?? null;
    }

    public function getOrderDate(): ?string
    {
        return $this->input('order.order_date') ?? null;
    }

    public function getOrderStatus(): ?string
    {
        return $this->input('order.status') ?? null;
    }

    public function getManager(): ?string
    {
        return $this->input('order.manager') ?? null;
    }

    public function getProviderId(): ?string
    {
        return $this->input('order.provider.id') ?? null;
    }

    public function getOrderSostavs(): array
    {
        return $this->input('order.orderSostavs');
    }
}
