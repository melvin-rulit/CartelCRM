<?php

namespace App\Http\Controllers;

use App\Http\Requests\Counterparties\CreateCounterpartiesRequest;
use App\Http\Requests\Counterparties\Order\CreateCountepartOrderRequest;
use App\Http\Requests\Counterparties\UpdateCounterpartRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\Counterparties\CounterpartiesResource;
use App\Http\Resources\Counterparties\Orders\OrderResource;
use App\Http\Resources\UserResource;
use App\Models\Counterparties;
use App\Models\CounterpartiesOrders;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Random\RandomException;

class CounterpartiesController extends Controller
{
    private const PER_PAGE = 20;
    private Counterparties $counterparties;
    private CounterpartiesOrders $counterpartiesOrders;

    public function __construct(Counterparties $counterparties, CounterpartiesOrders $counterpartiesOrders)
    {
        $this->counterparties = $counterparties;
        $this->counterpartiesOrders = $counterpartiesOrders;
    }

    public function list(Request $request): JsonResponse
    {
        $counterparties = $this->counterparties::all();

//        if ($query = $request->query('query')) {
//            $users->where('first_name', 'like', "%{$query}%")
//                ->orWhere('middle_name', 'like', "%{$query}%")
//                ->orWhere('last_name', 'like', "%{$query}%");
//        }

//        $users = $users->paginate(self::PER_PAGE);

        return new JsonResponse(
            [
                'counterparties' => CounterpartiesResource::collection($counterparties),
                'limit' => self::PER_PAGE,
                'url'   => route('counterparties.list')
            ]
        );
    }

    public function order_create(CreateCountepartOrderRequest $request): JsonResponse
    {
        $order = CounterpartiesOrders::create([
            'order_number' => $request->getOrderNumber(),
            'order_date' => $request->getOrderDate(),
            'delivery_address' => $request->getOrderAdress(),
            'status' => $request->getOrderStatus(),
            'manager_id' => $request->getManager(),
            'counterpart_id' => $request->getCountepartId(),
        ]);

//         Сохранение составов заказа

        foreach ($request->getOrderSostavs() as $sostav) {
            $order->sostavs()->create($sostav);
        }

        return new JsonResponse($order);
//        return new JsonResponse($request->getCountepartId());
    }

    /**
     * @throws RandomException
     */
    public function unique_order_number(): string
    {
        return substr(bin2hex(random_bytes(5)), 0, 10);
    }

    public function order_list(Request $request): JsonResponse
    {
        $orders = $this->counterpartiesOrders::query();


        if ($request->query('query')) {
            $orders->where('status', $request->query('query'));
        }

        $counterparties_order = $orders->get();

        return new JsonResponse(
            [
                'orders' => OrderResource::collection($counterparties_order),
                'url'   => route('counterparties_orders.list')
            ]
        );
    }
    public function store(CreateCounterpartiesRequest $request): JsonResponse
    {
        $Counterpart = $this->counterparties->newInstance();

        $Counterpart->first_name = $request->getFirstName();
        $Counterpart->middle_name = $request->getMiddleName();
        $Counterpart->last_name = $request->getLastName();
        $Counterpart->phone = $request->getPhone();
        $Counterpart->city = $request->getCity();
        $Counterpart->telegram = $request->getTelegramLogin();

        $Counterpart->save();

        return new JsonResponse(['counterparties' => CounterpartiesResource::make($Counterpart)]);
    }

    public function detail_show(int $id): JsonResponse
    {
        $counterpart = Counterparties::find($id);

        if (!$counterpart) {
            return $this->error('Контрагент не найден');
        }

        return new JsonResponse(['counterpart' => CounterpartiesResource::make($counterpart)]);
    }
    public function order_detail_show(int $id): JsonResponse
    {
        $counterpart_order = CounterpartiesOrders::find($id);

        if (!$counterpart_order) {
            return $this->error('Заказ не найден');
        }

        return new JsonResponse(['order' => OrderResource::make($counterpart_order)]);
    }

    public function counterpart_orders(int $id): JsonResponse
    {
        $counterpart_orders = CounterpartiesOrders::where('counterpart_id', $id)->get();

        if (!$counterpart_orders) {
            return response()->json(['message' => 'Нет заказов'], 404);
        }

        return new JsonResponse(['orders' => $counterpart_orders ]);
    }

    public function update(UpdateCounterpartRequest $request): JsonResponse
    {
        $counterpart = $this->counterparties->find($request->input('id'));

        if (!$counterpart) {
            return $this->error('Контрагент не найден');
        }

        $counterpart->first_name = $request->getFirstName();
        $counterpart->middle_name = $request->getMiddleName();
        $counterpart->last_name = $request->getLastName();
        $counterpart->phone = $request->getPhone();
        $counterpart->city = $request->getCity();
        $counterpart->telegram = $request->getTelegramLogin();

        $counterpart->save();

        return new JsonResponse(['counterpart' => CounterpartiesResource::make($counterpart)]);
    }

    public function delete(int $id): JsonResponse
    {
        $user = $this->users->find($id);

        if (!$user) {
            return $this->error('Пользователь не найден');
        }

        $user->delete();

        return $this->success();
    }

//    public function current(): JsonResponse
//    {
//        return new JsonResponse(['user' => UserResource::make(auth()->user())]);
//    }
//
//    public function managersList(): JsonResponse
//    {
//        $managersList = [];
//        $managers = User::whereIn('role_id', [User::ROLE_MANAGER, User::ROLE_ADMIN])->get();
//
//        foreach ($managers as $manager) {
//            $managersList[] = ['id' => $manager->id, 'name' => $manager->getFullName()];
//        }
//
//        return new JsonResponse(['managers' => $managersList]);
//    }
//
//    public function adminsList(): JsonResponse
//    {
//        $adminsList = [];
//        $admins = User::whereIn('role_id', [User::ROLE_MANAGER, User::ROLE_ADMIN])->get();
//
//        foreach ($admins as $admin) {
//            $adminsList[] = ['id' => $admin->id, 'name' => $admin->getFullName()];
//        }
//
//        return new JsonResponse(['admins' => $adminsList]);
//    }
//
//    public function investorsList(): JsonResponse
//    {
//        $adminsList = [];
//        $investors = User::where('role_id', '=', User::ROLE_INVESTOR)->get();
//
//        foreach ($investors as $investor) {
//            $adminsList[] = ['id' => $investor->id, 'name' => $investor->getFullName()];
//        }
//
//        return new JsonResponse(['investors' => $adminsList]);
//    }
//
//    public function getRoles()
//    {
//        return new JsonResponse(
//            [
//                'roles' => [
//                    ['id' => User::ROLE_ADMIN, 'name' => 'Администратор'],
//                    ['id' => User::ROLE_MANAGER, 'name' => 'Менеджер'],
//                    ['id' => User::ROLE_INVESTOR, 'name' => 'Инвестор'],
//                ]
//            ]
//        );
//    }
}
