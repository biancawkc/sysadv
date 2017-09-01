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
  public function showRegistrationForm($idPessoa)
  { 
    $funcionario= "";
    $advogado = "";
    $busca = "";

    $pessoaFisica = \DB::table('pessoa_fisica')->where('id_parte', $idPessoa)->first();

    $func= \DB::table('funcionario')->where('id_parte', $idPessoa)->first();

    if(is_null($func))
    {
      $adv = \DB::table('advogado')->where('id_parte', $idPessoa)->value('id_advogado');
      $busca = \DB::table('usuario')->where('id_advogado', $adv)->first();
    }
    else
    {
      $fun= \DB::table('funcionario')->where('id_parte', $idPessoa)->value('id_funcionario');
      $busca = \DB::table('usuario')->where('id_funcionario', $fun)->first();
    }

    return view('usuario.register_t')
    ->with('pessoaFisica',$pessoaFisica)
    ->with('funcionario', $funcionario)
    ->with('advogado', $advogado)
    ->with('busca', $busca);
    
  }

  public function showRegisterForm()
  { 
    $pessoaFisica = "";
    $busca = NULL;

    $funcionario = \DB::table('pessoa_fisica')
    ->join('funcionario', 'pessoa_fisica.id_parte', '=', 'funcionario.id_parte')
    ->leftJoin('usuario','usuario.id_funcionario','=', 'funcionario.id_funcionario')
    ->where('usuario.username','=', NULL)
    ->get();


    $advogado = \DB::table('pessoa_fisica')
    ->join('advogado', 'pessoa_fisica.id_parte', '=', 'advogado.id_parte')
    ->leftJoin('usuario','usuario.id_advogado','=', 'advogado.id_advogado')
    ->where('usuario.username','=', NULL)
    ->get();


    return view('usuario.register_t')
    ->with('pessoaFisica',$pessoaFisica)
    ->with('funcionario', $funcionario)
    ->with('advogado', $advogado)
    ->with('busca', $busca);
    
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
    $func= \DB::table('funcionario')->where('id_parte', $data['id_parte'])->first();
    if(is_null($func))
    {
      $advogado = \DB::table('advogado')->where('id_parte', $data['id_parte'])->value('id_advogado');
      $funcionario = NULL;
    }
    else
    {
      $funcionario = \DB::table('funcionario')->where('id_parte', $data['id_parte'])->value('id_funcionario');
      $advogado = NULL;
    }
    return Usuario::create([
      'username' => $data['username'],
      'email' => $data['email'],
      'administrador' => $data['administrador'],
      'ativo' => $data['ativo'],
      'id_funcionario' => $funcionario,
      'id_advogado' => $advogado,
      'password' => bcrypt($data['password']),
      ]);
  }

     //Get the guard to authenticate Seller
  protected function guard()
  {
   return Auth::guard('web_usuario');
  }

}
