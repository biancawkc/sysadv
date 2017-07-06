<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Redirect;

class AdvogadoController extends Controller
{	
	public function index()
	{
		 $advogados =  \DB::table('pessoa_fisica')
      ->join('advogado', 'pessoa_fisica.id_parte', '=', 'advogado.id_parte')
      ->get();

      return view('colaborador.advogado.index')
      ->with('advogados', $advogados);
	}

    public function create(Request $request)
	{  
		$cpf = $request->cpf;
		$tp_colab = $request->tp_colab;
		$civil = \App\Models\EstadoCivil::all(['desc_estado_civil', 'id_estado_civil']);
		//$tp_tel = \App\Models\TipoTel::all(['tp_telefone', 'id_tp_telefone']);
		$parte = \DB::table('pessoa_fisica')->where('cpf', $cpf)->first();
		$msg="";

		if(is_null($parte))
		{
			return view('colaborador.advogado.create')
			->with('cpf', $cpf)
			->with('tp_colab', $tp_colab)
			->with('civil', $civil);
			//->with('tp_tel', $tp_tel);

		}
		else
		{	
			$idParte = \DB::table('pessoa_fisica')->where('cpf', $cpf)->value('id_parte');
			$result = \DB::table('advogado')->where('id_parte', $idParte)->first();
			$result2 = \DB::table('funcionario')->where('id_parte', $idParte)->first();
			if(is_null($result) && is_null($result2))
			{
				return redirect('advogado/'.$idParte.'/review');

			}
			elseif($result2 !== NULL)
			{
				$msg="O CPF: $cpf já foi cadastrado como funcionário!";
				return view('colaborador.verify')
				->with('msg', $msg);
			}
			elseif($result !== NULL)
			{
			$msg="O advogado com CPF: $cpf já foi cadastrado!";
			return view('colaborador.verify')
			->with('msg', $msg);
			}
		}

	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'nome' => 'required|max:200',
			'rg' => 'required|max:9',
			'orgao_exp' => 'required|max:10',
			'cpf' => 'required|max:13',
			'ativo' =>'required'
			]);
		if ($validator->fails()) {
			return redirect('advogado/create')
			->withErrors($validator)
			->withInput();
		} else {
			
			$advogado = new \App\Models\Advogado();
			$pessoaFisica = new \App\Models\PessoaFisica();
			$parte = new \App\Models\Parte();
	
			$parte->ativo = $request->ativo;
			$parte->save();

			$pessoaFisica->id_parte = $parte->getAttribute("id_parte");
			$pessoaFisica->nome = $request->nome;
			$pessoaFisica->rg = $request->rg;
			$pessoaFisica->orgao_exp = $request->orgao_exp;
			$pessoaFisica->cpf = $request->cpf;
			$pessoaFisica->dt_nasc = $request->dt_nasc;
			$pessoaFisica->save();

			$advogado->oab = $request->oab;
			$advogado->seccional = $request->seccional;
			$advogado->id_parte = $pessoaFisica->getAttribute("id_parte");
			$advogado->save();

			flash()->success('Cadastro Inserido com Sucesso!');
			return redirect('/advogado/create');

		}
	}

	function review($id)
	{
		$civil = \App\Models\EstadoCivil::all(['desc_estado_civil', 'id_estado_civil']);
		$tp_tel = \App\Models\TipoTel::all(['tp_telefone', 'id_tp_telefone']);
		$pessoaFisica = \DB::table('pessoa_fisica')->where('id_parte','=', $id)->first();
		$parte =  \App\Models\Parte::find($id);
		$e = $pessoaFisica->id_estado_civil;
		return view('colaborador.advogado.review')
		->with('civil', $civil)
		->with('tp_tel', $tp_tel)
		->with('pessoaFisica', $pessoaFisica)
		->with('parte', $parte)
		->with('e', $e);
	}

	function updateReview(Request $request, $id)
	{	
			$validator = Validator::make($request->all(), [
			'nome' => 'required|max:200',
			'rg' => 'required|max:9',
			'orgao_exp' => 'required|max:10',
			'cpf' => 'required|max:13',
			'id_estado_civil'=>'required'
			]);
		if ($validator->fails()) {
			return redirect('pessoaFisica/'.$id.'/review')
			->withErrors($validator)
			->withInput();
		} else {

	/*		\App\Models\Parte::find($id)
			->update(['ativo' => $request->ativo]);*/

			$advogado = new \App\Models\Advogado();
			$advogado->oab = $request->oab;
			$advogado->seccional = $request->seccional;
			$advogado->id_parte = $id;
			$advogado->save();

			 \DB::table('pessoa_fisica')
			->where('id_parte','=', $id)
			->update([
       		 			'nome' => $request->nome,
        				'orgao_exp' => $request->orgao_exp,
        				'cpf' => $request->cpf,
        				'dt_nasc' => $request->dt_nasc,
        				'ctps' => $request->ctps,
        				'id_estado_civil' => $request->id_estado_civil
    				]);


			flash()->success('Cadastro Inserido com Sucesso!');
			return redirect('advogado/'.$id.'/review');
		}
	}
}
