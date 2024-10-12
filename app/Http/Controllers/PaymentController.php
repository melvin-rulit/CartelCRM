<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use App\Services\Notifier;
use Illuminate\Http\JsonResponse;
use Mockery\Matcher\Not;

class PaymentController extends Controller
{
    private Payment $payments;
//    private Notifier $notifier;

//    public function __construct(Payment $payments, Notifier $notifier)
    public function __construct(Payment $payments)
    {
        $this->payments = $payments;
//        $this->notifier = $notifier;
    }

    public function index(int $dealId): JsonResponse
    {
        $payments = $this->payments->where('deal_id', $dealId)
            ->get();

        return new JsonResponse(['payments' => PaymentResource::collection($payments)]);
    }

    public function store(CreatePaymentRequest $request, OrderController $dealController): JsonResponse
    {
        $payment = new Payment();

        $payment->created_at = $request->getDate();
        $payment->deal_id = $request->getDealId();
        $payment->rent = $request->getRent();
        $payment->buyout = $request->getBuyout();
        $payment->comment = $request->getBuyout();

        $payment->save();

        $phoneNumber = $payment->deal->client->phone_number;

        $content = base64_encode($dealController->payments($payment->deal_id));

//        $this->notifier->sendFile($phoneNumber, 'График платежей', 'payments.docx', $content);

        return new JsonResponse(['payment' => PaymentResource::make($payment)]);
    }

    public function update(int $dealId): JsonResponse
    {
        $payments = $this->payments->where('deal_id', $dealId)
            ->get();

        return new JsonResponse(['payments' => PaymentResource::collection($payments)]);
    }

    public function delete(int $paymentId): JsonResponse
    {
        $payment = $this->payments->find($paymentId);

        if (!$payment) {
            return $this->error('Платеж не найден');
        }

        $deal = $payment->deal;
        $payment->delete();

        $payments = $this->payments->where('deal_id', $deal->id)
            ->get();

        return new JsonResponse(['payments' => PaymentResource::collection($payments)]);
    }

    public function types(): JsonResponse
    {
        return new JsonResponse(
            [
                'types' => [
                    ['id' => Payment::TYPE_RENT, 'name' => 'Аренда'],
                    ['id' => Payment::TYPE_BUYOUT, 'name' => 'Выкуп']
                ]
            ]
        );
    }
}
