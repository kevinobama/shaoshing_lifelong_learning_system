<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Session;


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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * sign in.
     *
     * @return \Illuminate\Http\Response
     */
    public function doLogin()
    {
        $email = Input::get('email');
        $password = Input::get('password');

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = Auth::user();

            Session::put('user', $user);
            Session::put('userId', $user->id);
            Session::put('userName', $user->name);

            return redirect()->intended($this->redirectTo);
        } else {
            //Compatible　username
            $user = Auth::user();
            if (Auth::attempt(['name' => $email, 'password' => $password])) {
                $user = Auth::user();

                Session::put('user', $user);
                Session::put('userId', $user->id);
                Session::put('userName', $user->name);

                return redirect()->intended($this->redirectTo);
            } else {
                return redirect()->intended('login');
            }
        }
    }
}
