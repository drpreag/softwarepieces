<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Log;

class ChangePasswordController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function showChangePasswordForm()
    {
        $user = Auth::user();
        return view('auth.passwordchange')->withUser($user);
    }    

    public function change(Request $request) 
    {
        $this->validate(
            $request, array(
                'oldpassword'             => 'required|min:6',
                'password'               => 'required|min:6|confirmed',
            )
        ); 

        $user = Auth::user();

        if (Auth::attempt(array('email' => $request->email, 'password' => $request->oldpassword))) {

            Log::info('User #' . $user->id . ' ('. $user->name .') changed a password.'); 

            Session::flash('success', 'Password changed!');    
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect()->route('users.index');
        }

        Session::flash('error', 'Wrong credentials!');
        return redirect()->route('password.change');
    }
}
