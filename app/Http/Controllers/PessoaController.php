<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PessoaController extends Controller
{
    public function index()
	{
		$fisica =  \DB::table('parte')
		->join('pessoa_fisica', 'parte.id_parte', '=', 'pessoa_fisica.id_parte')
		->where('parte.ativo', '=', 1)
		->get();

		$jurid =  \DB::table('parte')
		->join('pessoa_juridica', 'parte.id_parte', '=', 'pessoa_juridica.id_parte')
		->where('parte.ativo', '=', 1)
		->get();

		return view('pessoa.index')
		->with('fisica', $fisica)
		->with('jurid', $jurid);
	}

		public function verify()
	{   
		$msg="";
		return view('pessoa.verify')
		->with('msg', $msg);
	}


}
