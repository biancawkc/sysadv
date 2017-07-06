<?php

namespace App\Http\Controllers\UsuarioAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Trait
use Illuminate\Foundation\Auth\ResetsPasswords;

//Auth Facade
use Illuminate\Support\Facades\Auth;

//Password Broker Facade
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
     use ResetsPasswords;

      protected $redirectTo = '/home';

     public function showResetForm(Request $request, $token = null)
    {
        return view('usuario.password.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }


    public function broker()
    {
        return Password::broker('usuarios');
    }


    protected function guard()
    {
        return Auth::guard('web_usuario');
    }
}
