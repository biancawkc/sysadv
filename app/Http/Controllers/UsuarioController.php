<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
