<?php

namespace App\Http\Controllers\UsuarioAuth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
     use SendsPasswordResetEmails;


    public function showLinkRequestForm()
    {
        return view('usuario.password.email');
    }

     public function broker()
    {
         return Password::broker('usuarios');
    }
}
