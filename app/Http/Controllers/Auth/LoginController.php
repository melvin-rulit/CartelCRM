<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $user = User::where('email', $request->input('email'))->first();

//        if (!$user || !$user->isEnabled()) {
//            $this->incrementLoginAttempts($request);
//            throw ValidationException::withMessages([
//                $this->username() => 'Ваша учетная запись отключена, вход на сайт недоступен. Обратитесь к администратору.',
//            ]);
//        }


        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            if ($user->first_login) {
                $user->first_login = false;
                $user->save();

                if ($user->first_name === null OR $user->middle_name === null OR $user->last_name === null OR $user->birthday === null
                OR $user->passport_series === null OR $user->passport_give === null OR $user->passport_number === null OR $user->passport_issuedBy === null
                OR $user->passport_issuedByDate === null OR $user->registration_address === null OR $user->live_adress === null OR $user->phone_number === null
                OR $user->telegram === null){

                    return redirect('/#/users/' . Auth::id());
                }
            }

            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request)
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
}
