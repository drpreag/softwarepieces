<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /*
        by drPreAG
        peace of code that assure only users with flag active==TRUE (active==1) can log in
        inactive users can not log in even is user/pass is OK
    */
    protected function validateLogin(Request $request)
    {
        $this->validate(
            $request,
            [$this->username() => 'required|exists:users,' . $this->username() . ',active,1','password'=>'required',],
            [$this->username() . '.exists' => 'The selected email is invalid or the account has been disabled.']
        );
    }    
}
