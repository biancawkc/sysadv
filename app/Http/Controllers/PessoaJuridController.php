<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Redirect;

class PessoaJuridController extends Controller
{
     public function create(Request $request)
	{  
		$cnpj = $request->cnpj;
		$tp_tel = \App\Models\TipoTel::all(['tp_telefone', 'id_tp_telefone']);

	return view('pessoa.pessoaJuridica.create')
	->with('cnpj', $cnpj)
	->with('tp_tel', $tp_tel);
		

	}
}
