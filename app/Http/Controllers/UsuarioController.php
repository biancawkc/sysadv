<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Redirect;

class UsuarioController extends Controller
{
    public function index()
    {
    	$funcionarios =  \DB::table('usuario')
		->join('funcionario', 'usuario.id_funcionario', '=', 'funcionario.id_funcionario')
		->join('pessoa_fisica', 'funcionario.id_parte', '=', 'pessoa_fisica.id_parte')
		->get();

		$advogados = \DB::table('usuario')
		->join('advogado', 'usuario.id_advogado', '=', 'advogado.id_advogado')
		->join('pessoa_fisica', 'advogado.id_parte', '=', 'pessoa_fisica.id_parte')
		->get();

		return view('usuario.index')
		->with('funcionarios', $funcionarios)
		->with('advogados', $advogados);
    }

    public function editFunc($id) {

     $usuario =  \DB::table('usuario')
        ->join('funcionario', 'usuario.id_funcionario', '=', 'funcionario.id_funcionario')
        ->join('pessoa_fisica', 'funcionario.id_parte', '=', 'pessoa_fisica.id_parte')
        ->where('usuario.id_usuario', '=', $id)
        ->first();

        return view('usuario.edit')
                        ->with('usuario', $usuario);
    }

    public function editAdv($id) {

     $usuario =  \DB::table('usuario')
        ->join('advogado', 'usuario.id_advogado', '=', 'advogado.id_advogado')
        ->join('pessoa_fisica', 'advogado.id_parte', '=', 'pessoa_fisica.id_parte')
        ->where('usuario.id_usuario', '=', $id)
        ->first();


        return view('usuario.edit')
                        ->with('usuario', $usuario);
    }

    public function update(Request $request, $id) {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'ativo' => 'required',
            //'username' => 'required|unique:usuario'
        );
        $validator = \Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return \Redirect::to('usuario/' . $id . '/edit')
                            ->withErrors($validator)
                            ->withInput();
        } else {
            // store
            $usuario = \App\Models\Usuario::find($id);
            $usuario->ativo = $request->ativo;
            $usuario->username = $request->username;
            $usuario->administrador = $request->administrador; 
            $usuario->save();

            flash()->success('Usuário Atualizado com Sucesso!');
            return redirect()->back();
        }
    }
}
