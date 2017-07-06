<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Redirect;

class PessoaFisicaController extends Controller
{
	public function index()
	{
		$pessoa =  \DB::table('parte')
		->join('pessoa_fisica', 'parte.id_parte', '=', 'pessoa_fisica.id_parte')
		->join('pessoa_juridica', 'parte.id_parte', '=', 'pessoa_juridica.id_parte')
		->where('parte.ativo', '=', 1)
		->get();

		return view('pessoa.index')
		->with('pessoa', $pessoa);
	}

	public function verify()
	{   
		$msg="";
		return view('pessoa.verify')
		->with('msg', $msg);
	}


	public function create(Request $request)
	{  
		$cpf = $request->cpf;
		$civil = \App\Models\EstadoCivil::all(['desc_estado_civil', 'id_estado_civil']);
		$tp_tel = \App\Models\TipoTel::all(['tp_telefone', 'id_tp_telefone']);

		$result = \DB::table('pessoa_fisica')->where('cpf', $cpf)->first();

		$msg = "";

		if(is_null($result))
		{
			return view('pessoa.pessoaFisica.create')
			->with('cpf', $cpf)
			->with('civil', $civil)
			->with('tp_tel', $tp_tel);
		}
		else
		{	
			$idParte = $result->id_parte;
			$result1 = \DB::table('funcionario')->where('id_parte', $idParte)->first();
			$result2 = \DB::table('parte')->where('id_parte', $idParte)->value('ativo');
			$result3 = \DB::table('advogado')->where('id_parte', $idParte)->first();

			if($result1 !== NULL && $result2 === 0)
			{
			return redirect('pessoaFisica/'.$idParte.'/review');
			}
			elseif ($result3 !== NULL && $result2 === 0) {
				
				return redirect('pessoaFisica/'.$idParte.'/review');
			}
			elseif( $result2 === 1)
			{
				$msg = "O CPF: $cpf já foi cadastrado!";

				return view('pessoa.verify')
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
			'ativo' =>'required',
			'email' => 'required',
			'cep'=> 'required',
			'logradouro'=> 'required',
			'bairro'=> 'required',
			'uf'=> 'required',
			'cidade'=> 'required',
			'id_estado_civil'=>'required'
			]);
		if ($validator->fails()) {
			return redirect('pessoaFisica/addPessoa')
			->withErrors($validator)
			->withInput();
		} else {
			
			$endereco = new \App\Models\Endereco();
			$pessoaFisica = new \App\Models\PessoaFisica();
			$parte = new \App\Models\Parte();
			$telefone = new \App\Models\Telefone();
			$profissao = new \App\Models\Profissao();

			$parte->ativo = $request->ativo;
			$parte->email = $request->email;
			$parte->save();

			if(!empty($request->nm_profissao))
			{
			$profissao->nm_profissao = $request->nm_profissao;
			$profissao->cbo = $request->cbo;
			$profissao->remuneracao = $request->remuneracao;
			$profissao->save();
			}

			$pessoaFisica->id_parte = $parte->getAttribute("id_parte");
			$pessoaFisica->nome = $request->nome;
			$pessoaFisica->rg = $request->rg;
			$pessoaFisica->orgao_exp = $request->orgao_exp;
			$pessoaFisica->cpf = $request->cpf;
			$pessoaFisica->dt_nasc = $request->dt_nasc;
			$pessoaFisica->id_estado_civil = $request->id_estado_civil;
			$pessoaFisica->ctps = $request->ctps;
			$pessoaFisica->id_profissao = $profissao->getAttribute("id_profissao");
			$pessoaFisica->save();

			$endereco->cep = $request->cep;
			$endereco->logradouro = $request->logradouro;
			$endereco->complemento = $request->complemento;
			$endereco->bairro = $request->bairro;
			$endereco->uf = $request->uf;
			$endereco->cidade = $request->cidade;
			$endereco->id_parte = $parte->getAttribute("id_parte");
			$endereco->save();

			/*foreach ($request->telefone   as  $value) {
				if(!empty($value)){*/
					$telefone->telefone = $request->telefone;
					$telefone->id_tp_telefone = $request->id_tp_telefone;
					$telefone->id_parte = $parte->getAttribute("id_parte");
					$telefone->save();
			 /*}
			}*/



			flash()->success('Cadastro Inserido com Sucesso!');
			return redirect('/pessoaFisica/addPessoa');

		}
	}

	function review($id)
	{
		$civil = \App\Models\EstadoCivil::all(['desc_estado_civil', 'id_estado_civil']);
		$tp_tel = \App\Models\TipoTel::all(['tp_telefone', 'id_tp_telefone']);
		$pessoaFisica = \DB::table('pessoa_fisica')->where('id_parte','=', $id)->first();
		$parte =  \App\Models\Parte::find($id);
		$e = $pessoaFisica->id_estado_civil;
		return view('pessoa.pessoaFisica.review')
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
			'ativo' =>'required',
			'email' => 'required',
			'cep'=> 'required',
			'logradouro'=> 'required',
			'bairro'=> 'required',
			'uf'=> 'required',
			'cidade'=> 'required',
			'id_estado_civil'=>'required'
			]);
		if ($validator->fails()) {
			return redirect('pessoaFisica/'.$id.'/review')
			->withErrors($validator)
			->withInput();
		} else {

			$endereco = new \App\Models\Endereco();
			$telefone = new \App\Models\Telefone();
			$profissao = new \App\Models\Profissao();

		   \App\Models\Parte::where('id_parte', '=', $id)
    		->update(['email' => $request->email]);

    		\App\Models\Parte::where('id_parte', '=', $id)
    		->update(['ativo' => $request->ativo]);

    		$profissao->nm_profissao = $request->nm_profissao;
			$profissao->cbo = $request->cbo;
			$profissao->remuneracao = $request->remuneracao;
			$profissao->save();

			$endereco->cep = $request->cep;
			$endereco->logradouro = $request->logradouro;
			$endereco->complemento = $request->complemento;
			$endereco->bairro = $request->bairro;
			$endereco->uf = $request->uf;
			$endereco->cidade = $request->cidade;
			$endereco->id_parte = $id;
			$endereco->save();

			$prof = $profissao->getAttribute("id_profissao");

			\App\Models\PessoaFisica::where('id_parte', '=', $id)
    		->update(['id_profissao' => $prof]);

				/*foreach ($request->telefone   as  $value) {
				if(!empty($value)){*/
					$telefone->telefone = $request->telefone;
					$telefone->id_tp_telefone = $request->id_tp_telefone;
					$telefone->id_parte = $id;
					$telefone->save();
			 /*}
			}*/


			flash()->success('Cadastro Inserido com Sucesso!');
			return redirect('pessoaFisica/'.$id.'/review');
		}
	}

	function edit($id)
	{	
		$civil = \App\Models\EstadoCivil::all(['desc_estado_civil', 'id_estado_civil']);
		$tp_tel = \App\Models\TipoTel::all(['tp_telefone', 'id_tp_telefone']);

		$idEndereco = \DB::table('endereco')->where('id_parte','=', $id)->value('id_endereco');
		$idTel = \DB::table('telefone')->where('id_parte','=', $id)->value('id_telefone');

		$pessoaFisica = \DB::table('pessoa_fisica')->where('id_parte','=', $id)->first();
		$endereco =  \App\Models\Endereco::find($idEndereco);
		$parte =  \App\Models\Parte::find($id);
		$telefone =  \App\Models\Telefone::find($idTel);

		$estadoCivil = $pessoaFisica->id_estado_civil;

		return view('pessoa.pessoaFisica.edit')
		->with('civil', $civil)
		->with('tp_tel', $tp_tel)
		->with('pessoaFisica', $pessoaFisica)
		->with('parte', $parte)
		->with('endereco', $endereco)
		->with('telefone', $telefone)
		->with('estadoCivil',$estadoCivil);
	}
}
