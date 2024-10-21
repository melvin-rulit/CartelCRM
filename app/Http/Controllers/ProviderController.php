<?php

namespace App\Http\Controllers;

use App\Http\Requests\Providers\CreateProviderRequest;
use App\Http\Resources\Providers\Orders\OrderResource;
use App\Http\Resources\Providers\Orders\SuccessfulOrderResource;
use App\Http\Resources\Providers\ProvidersResource;
use App\Models\Providers;
use App\Models\ProvidersOrders;
use Illuminate\Http\JsonResponse;

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

    public function successful_orders($id): JsonResponse
    {
        $provider_orders = ProvidersOrders::where('provider_id', $id)->where('status', 'completed')->get();

        if (!$provider_orders) {
            return $this->error('Нет выполненных заказов');
        }

        return new JsonResponse(['orders' => SuccessfulOrderResource::collection($provider_orders)]);
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
//
//    public function update(UpdateProxyRequest $request, int $id): JsonResponse
//    {
//        $proxy = $this->proxy->find($id);
//
//        if (!$proxy) {
//            return $this->error('Доверенность не найдена');
//        }
//
//        $proxy->delegate_id = $request->getDelegateId();
//        $proxy->owner_id = $request->getOwnerId();
//        $proxy->number = $request->getNumber();
//        $proxy->valid_until = $request->getValidUntil();
//        $proxy->issued_by = $request->getIssuedBy();
//        $proxy->issued_number = $request->getIssuedNumber();
//
//        $proxy->save();
//
//        return new JsonResponse(['proxy' => ProvidersResource::make($proxy)]);
//    }
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
