<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
        $this->middleware('guest')->except('logout');
    }


    public function login(Request $request)
    {
        $this->validate($request, [
            'emailOrPhone'    => 'required',
            'password' => 'required',
            ]);

        $login_type = filter_var($request->input('emailOrPhone'), FILTER_VALIDATE_EMAIL ) 
        ? 'email' 
        : 'phone';

        $request->merge([
            $login_type => $request->input('emailOrPhone')
            ]);

        if (\Auth::attempt($request->only($login_type, 'password'))) {
            return redirect()->intended($this->redirectPath());
        }

        return redirect()->back()
        ->withInput()
        ->withErrors([
            'emailOrPhone' => 'These credentials do not match our records.',
            ]);
    } 

}
