<?php

namespace App\Http\Controllers;

use App\Http\Requests\Providers\CreateProviderRequest;
use App\Http\Requests\Providers\Order\CreateProviderOrderRequest;
use App\Http\Requests\Providers\UpdateProvideRequest;
use App\Http\Resources\Providers\Orders\OrderResource;
use App\Http\Resources\Providers\Orders\SuccessfulOrderResource;
use App\Http\Resources\Providers\ProvidersResource;
use App\Models\Providers;
use App\Models\ProvidersOrders;
use App\Models\ProvidersOrdersSostav;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Random\RandomException;

class ProviderController extends Controller
{
    private Providers $providers;
    private ProvidersOrders $providersOrder;

    public function __construct(Providers $providers, ProvidersOrders $providersOrder)
    {
        $this->providers = $providers;
        $this->providersOrder = $providersOrder;
    }

    public function list(): JsonResponse
    {
        $providers = $this->providers::all();

        return new JsonResponse(['providers' => ProvidersResource::collection($providers)]);
    }

    /**
     * @throws RandomException
     */
    public function unique_order_number(): string
    {
        return substr(bin2hex(random_bytes(5)), 0, 10);
    }

    public function order_list(): JsonResponse
    {
        $orders = $this->providersOrder::all();

        return new JsonResponse(
            [
                'orders' => OrderResource::collection($orders),
//                'deal_static_type' => ['1' => Deal::KIND_WITH_OWNER, '2' => Deal::KIND_WITH_PROXY],
//                'limit' => self::PER_PAGE,
//                'total' => $orders->total(),
                'url' => route('providers_orders.list')
            ]
        );
    }

    public function order_create(CreateProviderOrderRequest $request): JsonResponse
    {
        $order = ProvidersOrders::create([
            'order_number' => $request->getOrderNumber(),
            'order_date' => $request->getOrderDate(),
            'status' => $request->getOrderStatus(),
            'manager_id' => $request->getManager(),
            'provider_id' => $request->getProviderId(),
        ]);

        // Сохранение составов заказа

        foreach ($request->getOrderSostavs() as $sostav) {
            $order->sostavs()->create($sostav);
        }

       return new JsonResponse($order);
    }

    public function successful_orders($id): JsonResponse
    {
        $provider_orders = ProvidersOrders::where('provider_id', $id)->where('status', 'completed')->get();

        if (!$provider_orders) {
            return $this->error('Нет выполненных заказов');
        }

        return new JsonResponse(['orders' => SuccessfulOrderResource::collection($provider_orders)]);
    }

    public function update_order_status(Request $request, $order): JsonResponse
    {

//        $provider_order = ProvidersOrders::where('id', $order)->get();
//        $provider_order->status = 'completed';
//        $provider_order->save();

        return response()->json($order['id']);
    }

    public function store(CreateProviderRequest $request): JsonResponse
    {
        $provider = $this->providers->newInstance();

        $provider->first_name = $request->getFirstName();
        $provider->middle_name = $request->getMiddleName();
        $provider->last_name = $request->getLastName();
        $provider->phone = $request->getPhone();
        $provider->city = $request->getCity();
        $provider->telegram = $request->getTelegramLogin();

        $provider->save();

        return new JsonResponse(['provider' => ProvidersResource::make($provider)]);
    }

    public function detail_show(int $id): JsonResponse
    {
        $providers = $this->providers->find($id);

        if (!$providers) {
            return $this->error('Поставщик не найден');
        }

        return new JsonResponse(['provider' => ProvidersResource::make($providers)]);

    }

    public function order_detail_show(int $id): JsonResponse
    {
        $counterpart_order = $this->providersOrder::find($id);

        if (!$counterpart_order) {
            return $this->error('Заказ не найден');
        }

        return new JsonResponse(['order' => OrderResource::make($counterpart_order)]);
    }

    public function update(UpdateProvideRequest $request): JsonResponse
    {
        $provider = $this->providers->find($request->input('id'));

        if (!$provider) {
            return $this->error('Поставщик не найден');
        }

        $provider->first_name = $request->getFirstName();
        $provider->middle_name = $request->getMiddleName();
        $provider->last_name = $request->getLastName();
        $provider->phone = $request->getPhone();
        $provider->city = $request->getCity();
        $provider->telegram = $request->getTelegramLogin();

        $provider->save();

        return new JsonResponse(['provider' => ProvidersResource::make($provider)]);
    }

//
//    public function delete(int $id): JsonResponse
//    {
//        $proxy = $this->proxy->find($id);
//
//        if (!$proxy) {
//            return $this->error('Доверенность не найдена');
//        }
//
//        $proxy->delete();
//
//        return $this->success();
//    }
}
