<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\Users\UserDetailResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    private const PER_PAGE = 20;

    public function __construct(private User $users)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $user = $this->getUser();

//        if ($user->isAdmin()) {
//            $users = $this->users;
//        } else {
//            $users = $this->users->where('branch_id', $user->getBranchId());
//        }
        $users = $this->users;
        if ($query = $request->query('query')) {
            $users->where('first_name', 'like', "%{$query}%")
                ->orWhere('middle_name', 'like', "%{$query}%")
                ->orWhere('last_name', 'like', "%{$query}%");
        }

        $users = $users->paginate(self::PER_PAGE);

        return new JsonResponse(
            [
                'users' => UserResource::collection($users),
                'limit' => self::PER_PAGE,
                'total' => $users->total(),
                'url'   => route('users.list')
            ]
        );
    }

    public function store(CreateUserRequest $request): JsonResponse
    {
        $user = $this->users->newInstance();

        $user->first_name = $request->getFirstName();
        $user->middle_name = $request->getMiddleName();
        $user->last_name = $request->getLastName();
        $user->birthday = $request->getBirthday();
        $user->email = $request->getEmail();
        $user->password = \Hash::make($request->getPassword());
        $user->password_see = $request->getPassword();
        $user->passport_series = $request->getPassportSeries();
        $user->passport_give = $request->getPassportGive();
        $user->passport_number = $request->getPassportNumber();
        $user->passport_issuedBy = $request->getPassportIssuedBy();
        $user->passport_issuedByDate = $request->getPassportIssuedByData();
        $user->registration_address = $request->getRegistrationAddress();
        $user->live_adress  = $request->getLiveAddress();
        $user->phone_number = $request->getPhone();
        $user->telegram  = $request->getTelegram();

//        $user->branch_id = $request->getBranchId();
//        $user->role_id = $request->getRoleId();
//        $user->enabled = $request->isEnabled();
        $user->save();

            // Назначение роли новому пользователю
            $user->assignRole($request->get('role'));

        return new JsonResponse(['user' => UserResource::make($user)]);
    }

    public function show(int $id): JsonResponse
    {
        $user = $this->users->find($id);

        if (!$user) {
            return $this->error('Пользователь не найден');
        }

        return new JsonResponse(['user' => UserDetailResource::make($user), 'role' => auth()->user()->getRoleNames()->first()]);
    }

    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        $user = $this->users->find($id);

        if (!$user) {
            return $this->error('Пользователь не найден');
        }

        $user->first_name = $request->getFirstName();
        $user->middle_name = $request->getMiddleName();
        $user->last_name = $request->getLastName();
        $user->birthday = $request->getBirthday();
        $user->email = $request->getEmail();

        $user->passport_series = $request->getPassportSeries();
        $user->passport_give = $request->getPassportGive();
        $user->passport_number = $request->getPassportNumber();
        $user->passport_issuedBy = $request->getPassportIssuedBy();
        $user->passport_issuedByDate = $request->getPassportIssuedByData();
        $user->registration_address = $request->getRegistrationAddress();
        $user->live_adress  = $request->getLiveAddress();
        $user->phone_number = $request->getPhone();
        $user->telegram = $request->getTelegram();
//        $user->comment = $request->getComment();

        if ($request->getPassword()) {
            $user->password = \Hash::make($request->getPassword());
            $user->password_see = $request->getPassword();
        }

        // Назначение роли пользователю
        $user->assignRole($request->get('role'));

        $user->save();

        return new JsonResponse(['user' => UserResource::make($user)]);
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

    public function current(): JsonResponse
    {
        return new JsonResponse(['user' => UserResource::make(auth()->user()), 'role' => auth()->user()->getRoleNames()->first()]);
    }

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

    public function getRoles(): JsonResponse
    {
        $roles = Role::all();
        return new JsonResponse(
            [
                'roles' => $roles->toArray()
            ]
        );
    }
}
