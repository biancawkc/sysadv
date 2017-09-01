<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Redirect;

class PessoaJuridController extends Controller
{
	public function create(Request $request)
	{  
		$cnpj = $request->cnpjs;
		$tp_tel = \App\Models\TipoTel::all(['tp_telefone', 'id_tp_telefone']);
		
		$r = \DB::table('pessoa_juridica')->where('cnpj','=', $cnpj)->first();

		$msg = "";

		if(is_null($r))
		{
			return view('pessoa.pessoaJuridica.create')
			->with('cnpj', $cnpj)
			->with('tp_tel', $tp_tel);
		}
		else
		{
			$msg = "O CNPJ: $cnpj já foi cadastrado!";

				return view('pessoa.verify')
				->with('msg', $msg);
		}
	}


	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'cnpj' => 'required|max:16|unique:pessoa_juridica,cnpj',
			'razao_social' => 'required|max:100',
			'email' => 'required',
			'cep'=> 'required',
			'logradouro'=> 'required',
			'bairro'=> 'required',
			'uf'=> 'required',
			'cidade'=> 'required',
			]);
		if ($validator->fails()) {
			return redirect('pessoaJuridica/create')
			->withErrors($validator)
			->with('cnpj', $cnpj)
			->withInput();
		} else {
			
			$endereco = new \App\Models\Endereco();
			$pessoaJuridica = new \App\Models\PessoaJuridica();
			$parte = new \App\Models\Parte();
			$telefone = new \App\Models\Telefone();

			$parte->ativo = 1;
			$parte->email = $request->email;
			$parte->save();

			$pessoaJuridica->id_parte = $parte->getAttribute("id_parte");
			$pessoaJuridica->razao_social = $request->razao_social;
			$pessoaJuridica->nm_fantasia = $request->nm_fantasia;
			$pessoaJuridica->ins_estadual = $request->ins_estadual;
			$pessoaJuridica->desc_atividades = $request->desc_atividades;
			$pessoaJuridica->cnpj = $request->cnpj;
			$pessoaJuridica->save();

			$endereco->cep = $request->cep;
			$endereco->logradouro = $request->logradouro;
			$endereco->complemento = $request->complemento;
			$endereco->bairro = $request->bairro;
			$endereco->uf = $request->uf;
			$endereco->cidade = $request->cidade;
			$endereco->numero = $request->numero;
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
			return redirect('/pessoa/');

		}
	}

	public function edit($id)
	{
		$pessoaJuridica = \App\Models\PessoaJuridica::where('id_parte',$id)->first();
		$endereco = \App\Models\Endereco::where('id_parte', $id)->first();
		$parte = \App\Models\Parte::find($id);
		$telefone = \App\Models\Telefone::where('id_parte', $id)->first();
		$tp_tel = \App\Models\TipoTel::all(['tp_telefone', 'id_tp_telefone']);

		return view('pessoa.pessoaJuridica.edit')
		->with('pessoaJuridica', $pessoaJuridica)
		->with('endereco', $endereco)
		->with('parte', $parte)
		->with('telefone', $telefone)
		->with('tp_tel', $tp_tel);
	}

	public function update(Request $request, $id)
	{	
		$validator = Validator::make($request->all(), [
			'cnpj' => 'required|max:16',
			'razao_social' => 'required|max:100',
			'ativo' =>'required',
			'email' => 'required',
			'cep'=> 'required',
			'logradouro'=> 'required',
			'bairro'=> 'required',
			'uf'=> 'required',
			'cidade'=> 'required',
			]);
		if ($validator->fails()) {
			return redirect('pessoaJuridica/'.$id.'/edit')
			->withErrors($validator)
			->withInput();
		} else {	

			$pessoaJuridica = \App\Models\PessoaJuridica::where('id_parte',$id)->first();
			$endereco = \App\Models\Endereco::where('id_parte', $id)->first();
			$parte = \App\Models\Parte::where('id_parte',$id)->first();
			$telefone = \App\Models\Telefone::where('id_parte', $id)->first();
			$tp_tel = \App\Models\TipoTel::all(['tp_telefone', 'id_tp_telefone']);

			$parte->ativo = $request->ativo;
			$parte->email = $request->email;
			$parte->save();

			$pessoaJuridica->razao_social = $request->razao_social;
			$pessoaJuridica->nm_fantasia = $request->nm_fantasia;
			$pessoaJuridica->ins_estadual = $request->ins_estadual;
			$pessoaJuridica->desc_atividades = $request->desc_atividades;
			$pessoaJuridica->cnpj = $request->cnpj;
			$pessoaJuridica->save();

			$endereco->cep = $request->cep;
			$endereco->logradouro = $request->logradouro;
			$endereco->complemento = $request->complemento;
			$endereco->bairro = $request->bairro;
			$endereco->uf = $request->uf;
			$endereco->cidade = $request->cidade;
			$endereco->numero = $request->numero;
			$endereco->save();

			/*foreach ($request->telefone   as  $value) {
				if(!empty($value)){*/
					/*$telefone->telefone = $request->telefone;
					$telefone->id_tp_telefone = $request->id_tp_telefone;
					$telefone->id_parte = $parte->getAttribute("id_parte");
					$telefone->save();*/
			 /*}
			}*/

			flash()->success('Dados Alterado com Sucesso!');
			return redirect('/pessoaJuridica/'.$id.'edit');
		}

	}

	public function show($id)
	{
		$pessoaJuridica = \App\Models\PessoaJuridica::where('id_parte',$id)->first();
		$endereco = \App\Models\Endereco::where('id_parte', $id)->first();
		$parte = \App\Models\Parte::find($id);
		$telefone = \App\Models\Telefone::where('id_parte', $id)->first();
		$tp_tel = \App\Models\TipoTel::all(['tp_telefone', 'id_tp_telefone']);

		return view('pessoa.pessoaJuridica.show')
		->with('pessoaJuridica', $pessoaJuridica)
		->with('endereco', $endereco)
		->with('parte', $parte)
		->with('telefone', $telefone)
		->with('tp_tel', $tp_tel);
	}

	public function remove($id)
	{
		$pessoaJuridica = \DB::table('pessoa_juridica')->where('id_parte','=', $id)->first();

		$processo = \DB::table('parte_tem_processo')->where('id_parte','=', $id)->first();

		if(is_null($processo))
		{
			return view('pessoa.pessoaJuridica.remove')
			->with('pessoaJuridica', $pessoaJuridica);
		}
		else
		{
			flash()->overlay('Não é possível deletar os dados de '.$pessoaJuridica->razao_social.', pois está vinculado com pelo menos um processo.','Atenção');
			return redirect('pessoaJuridica/'.$id.'/show');
		}
	}
	

	public function destroy($id)
	{
		$pessoaJuridica = \DB::table('pessoa_juridica')->where('id_parte','=', $id)->first();
		
		\DB::delete('DELETE FROM endereco WHERE id_parte ='.$id);
		\DB::delete('DELETE FROM telefone WHERE id_parte ='.$id);
		\DB::delete('DELETE FROM pessoa_juridica WHERE id_parte ='.$id);
		\DB::delete('DELETE FROM parte WHERE id_parte ='.$id);

		flash()->success('Pessoa Jurídica Excluída com Sucesso!');
		return redirect('pessoa/');
	}
}
