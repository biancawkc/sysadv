<?php

namespace App\Http\Controllers\UsuarioAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Class needed for login and Logout logic
use Illuminate\Foundation\Auth\AuthenticatesUsers;

//Auth facade
use Auth;

class LoginController extends Controller
{
    //Where to redirect seller after login.
  protected $redirectTo = '/home';

    //Trait
  use AuthenticatesUsers;

    //Custom guard for seller
  protected function guard()
  {
    return Auth::guard('web_usuario');
  }

/*  public function logout(Request $request)
  {
    $this->guard()->logout();

    $request->session()->flush();

    $request->session()->regenerate();

    return redirect('/');
  }*/

  public function username()
  {
    return 'username';
  }

  protected function credentials(Request $request)
  {
    return array_merge($request->only($this->username(), 'password'), ['ativo' => 1]);
  }
    //Shows seller login form
  public function showLoginForm()
  {
   return view('usuario.login');
 }
 
}
