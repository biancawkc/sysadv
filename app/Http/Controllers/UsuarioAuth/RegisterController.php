<?php


namespace App\Http\Controllers\UsuarioAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Validator facade used in validator method
use Illuminate\Support\Facades\Validator;

//Seller Model
use App\Models\Usuario;

//Auth Facade used in guard
use Auth;


class RegisterController extends Controller
{

	protected $redirectPath = 'home';

	//shows registration form to seller
    public function showRegistrationForm()
  { 
     // $funcionarios = \App\Models\PessoaFisica::all(['nome', 'id_parte']);

      /* $funcionario = \DB::table('pessoa_fisica')
            ->join('funcionario', 'pessoa_fisica.id_parte', '=', 'funcionario.id_parte');
            //->join('advogado', 'advogado.id_parte', '=', 'advogado.id_parte')
           

      $people = \DB::table('pessoa_fisica')
            //->join('funcionario', 'pessoa_fisica.id_parte', '=', 'funcionario.id_parte')
            ->join('advogado', 'advogado.id_parte', '=', 'advogado.id_parte')
           /* ->union($funcionario)*/
          /*  ->get();*/


      return view('usuario.register');
      //->with('people',$people);
  }

  //Handles registration request for seller
    public function register(Request $request)
    {

       //Validates data
        $this->validator($request->all())->validate();

       //Create seller
        $usuario = $this->create($request->all());

        //Authenticates seller
        $this->guard()->login($usuario);

        return redirect($this->redirectPath);
    }

    //Validates user's Input
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255|unique:usuario',
            'email' => 'required|email|max:255|unique:usuario',
            'password' => 'required|min:6|confirmed',
            'administrador' => 'required',
            'ativo' => 'required',
        ]);
    }

    //Create a new seller instance after a validation.
    protected function create(array $data)
    {
        return Usuario::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'administrador' => $data['administrador'],
            'ativo' => $data['ativo'],
            'password' => bcrypt($data['password']),
        ]);
    }

     //Get the guard to authenticate Seller
   protected function guard()
   {
       return Auth::guard('web_usuario');
   }

}
