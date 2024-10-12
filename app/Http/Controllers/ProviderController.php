<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProxyRequest;
use App\Http\Resources\Providers\Orders\OrderResource;
use App\Http\Resources\Providers\ProvidersResource;
use App\Models\Providers;
use App\Models\ProvidersOrders;
use Illuminate\Http\JsonResponse;

class ProviderController extends Controller
{
    private Providers $providers;

    public function __construct(Providers $providers)
    {
        $this->providers = $providers;
    }

    public function list(): JsonResponse
    {
        $providers = $this->providers::all();

        return new JsonResponse(['providers' => ProvidersResource::collection($providers)]);
    }


    public function order_list(): JsonResponse
    {
        $orders = ProvidersOrders::all();
//        $orders = $query->paginate(self::PER_PAGE);

        return new JsonResponse(
            [
                'orders' => OrderResource::collection($orders),
//                'deal_static_type' => ['1' => Deal::KIND_WITH_OWNER, '2' => Deal::KIND_WITH_PROXY],
//                'limit' => self::PER_PAGE,
//                'total' => $orders->total(),
                'url'   => route('orders.list')
            ]
        );
    }



    public function store(CreateProxyRequest $request): JsonResponse
    {
        $provider = $this->providers->newInstance();

        $provider->delegate_id = $request->getDelegateId();
//        $proxy->owner_id = $request->getOwnerId();
//        $proxy->number = $request->getNumber();
//        $proxy->valid_until = $request->getValidUntil();
//        $proxy->issued_by = $request->getIssuedBy();
//        $proxy->issued_number = $request->getIssuedNumber();

        $provider->save();

        return new JsonResponse(['proxy' => ProvidersResource::make($provider)]);
    }

    public function show(int $id): JsonResponse
    {
        $providers = $this->providers->find($id);

        if (!$providers) {
            return $this->error('Поставщик не найден');
        }

        return new JsonResponse(['provider' => ProvidersResource::make($providers)]);
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
