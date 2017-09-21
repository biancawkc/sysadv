<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Redirect;


class FuncionarioController extends Controller
{

	public function index()
	{
		$funcionarios =  \DB::table('funcionario')
		->join('pessoa_fisica', 'pessoa_fisica.id_parte', '=', 'funcionario.id_parte')
		->get();

		$advogados =  \DB::table('pessoa_fisica')
		->join('advogado', 'pessoa_fisica.id_parte', '=', 'advogado.id_parte')
		->get();

		return view('colaborador.index')
		->with('funcionarios', $funcionarios)
		->with('advogados', $advogados);
	}


	public function verify()
	{   
		$msg="";
		return view('colaborador.verify')
		->with('msg', $msg);
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
			return view('colaborador.funcionario.create')
			->with('cpf', $cpf)
			->with('tp_colab', $tp_colab)
			->with('civil', $civil);
			//->with('tp_tel', $tp_tel);

		}
		else
		{	
			$idParte = \DB::table('pessoa_fisica')->where('cpf', $cpf)->value('id_parte');
			$result = \DB::table('funcionario')->where('id_parte', $idParte)->first();
			if(is_null($result))
			{
				return redirect('funcionario/'.$idParte.'/review');
			}
			else
			{
				$msg="O funcionário com CPF: $cpf já foi cadastrado!";
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
			'cpf' => 'required|max:13|unique:pessoa_fisica,cpf',
			'id_estado_civil' => 'required'
			]);
		if ($validator->fails()) {
			return redirect('funcionario/create')
			->withErrors($validator)
			->withInput();
		} else {
			$funcionario = new \App\Models\Funcionario();
			$pessoaFisica = new \App\Models\PessoaFisica();
			$parte = new \App\Models\Parte();

			$parte->ativo = 0;
			$parte->save();

			$pessoaFisica->id_parte = $parte->getAttribute("id_parte");
			$pessoaFisica->nome = $request->nome;
			$pessoaFisica->rg = $request->rg;
			$pessoaFisica->orgao_exp = $request->orgao_exp;
			$pessoaFisica->cpf = $request->cpf;
			$pessoaFisica->ctps = $request->ctps;
			$pessoaFisica->id_estado_civil = $request->id_estado_civil;

			$str = $request->dt_nasc;
			$data = explode("/", $str);
			$data = $data[2] . "-" . $data[1] . "-" . $data[0];
			$pessoaFisica->dt_nasc = new \DateTime($data);
			$pessoaFisica->save();

			//$funcionario->dt_admissao = $request->dt_admissao;
			$str2 = $request->dt_admissao;
			$data2 = explode("/", $str2);
			$data2 = $data2[2] . "-" . $data2[1] . "-" . $data2[0];
			$funcionario->dt_admissao = new \DateTime($data2);
			
			$funcionario->qualificacoes = $request->qualificacoes;
			$funcionario->id_parte = $pessoaFisica->getAttribute("id_parte");
			$funcionario->save();

			//flash()->success('Cadastro Inserido com Sucesso!');
			return redirect('cadastrar_usuario/'.$funcionario->id_parte);

		}
	}

	public function review($id)
	{
		$civil = \App\Models\EstadoCivil::all(['desc_estado_civil', 'id_estado_civil']);
		$tp_tel = \App\Models\TipoTel::all(['tp_telefone', 'id_tp_telefone']);
		$pessoaFisica = \DB::table('pessoa_fisica')->where('id_parte','=', $id)->first();
		$parte =  \App\Models\Parte::find($id);
		$e = $pessoaFisica->id_estado_civil;
		return view('colaborador.funcionario.review')
		->with('civil', $civil)
		->with('tp_tel', $tp_tel)
		->with('pessoaFisica', $pessoaFisica)
		->with('parte', $parte)
		->with('e', $e);
	}

	public function updateReview(Request $request, $id)
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

	$funcionario = new \App\Models\Funcionario();
	$funcionario->dt_admissao = $request->dt_admissao;
	$funcionario->qualificacoes = $request->qualificacoes;
	$funcionario->id_parte = $id;
	$funcionario->save();

	$str = $request->dt_nasc;
	$data = explode("/", $str);
	$data = $data[2] . "-" . $data[1] . "-" . $data[0];

	\DB::table('pessoa_fisica')
	->where('id_parte','=', $id)
	->update([
		'nome' => $request->nome,
		'orgao_exp' => $request->orgao_exp,
		//'cpf' => $request->cpf,
		'dt_nasc' => $data,
		'ctps' => $request->ctps,
		'id_estado_civil' => $request->id_estado_civil
		]);


	flash()->success('Cadastro Inserido com Sucesso!');
	return redirect('funcionario/'.$id.'/review');
}
}

public function edit($idFuncionario)
{
	$funcionario =  \DB::table('pessoa_fisica')
	->join('funcionario', 'pessoa_fisica.id_parte', '=', 'funcionario.id_parte')
	->where('funcionario.id_funcionario', '=', $idFuncionario)
	->first();

	$civil = \App\Models\EstadoCivil::all(['desc_estado_civil', 'id_estado_civil']);
	$tp_tel = \App\Models\TipoTel::all(['tp_telefone', 'id_tp_telefone']);

	return view('colaborador.funcionario.edit')
	->with('funcionario', $funcionario)
	->with('civil', $civil)
	->with('tp_tel', $tp_tel);
}

public function update(Request $request, $idFuncionario)
{
	$validator = Validator::make($request->all(), [
		'nome' => 'required|max:200',
		'rg' => 'required|max:9',
		'orgao_exp' => 'required|max:10',
		'cpf' => 'required|max:13',
		'id_estado_civil'=>'required'
		]);
	if ($validator->fails()) {
		return redirect('funcionario/'.$idFuncionario.'/edit')
		->withErrors($validator)
		->withInput();
	} else {

		$funcionario = \App\Models\Funcionario::find($idFuncionario);

		$str = $request->dt_nasc;
		$data = explode("/", $str);
		$data = $data[2] . "-" . $data[1] . "-" . $data[0];
		
		\DB::table('pessoa_fisica')
		->where('id_parte','=', $funcionario->id_parte)
		->update([
			'nome' => $request->nome,
			'orgao_exp' => $request->orgao_exp,
			'cpf' => $request->cpf,
			'dt_nasc' => $data,
			'ctps' => $request->ctps,
			'id_estado_civil' => $request->id_estado_civil
			]);

		$funcionario->dt_admissao = $request->dt_admissao;
		$funcionario->dt_demissao = $request->dt_demissao;
		$funcionario->qualificacoes = $request->qualificacoes;
		$funcionario->save();

		flash()->success('Dados Alterados com Sucesso!');
		return redirect('/funcionario/'.$idFuncionario.'/edit');
	}
}

public function show($idFuncionario)
{
	$funcionario =  \DB::table('pessoa_fisica')
	->join('funcionario', 'pessoa_fisica.id_parte', '=', 'funcionario.id_parte')
	->where('funcionario.id_funcionario', '=', $idFuncionario)
	->first();

	$civil = \App\Models\EstadoCivil::find($funcionario->id_estado_civil);

	return view('colaborador.funcionario.show')
	->with('funcionario', $funcionario)
	->with('civil', $civil);
}

public function remove($idFuncionario)
{	
	$funcionario =  \DB::table('pessoa_fisica')
	->join('funcionario', 'pessoa_fisica.id_parte', '=', 'funcionario.id_parte')
	->where('funcionario.id_funcionario', '=', $idFuncionario)
	->first();

	return view('colaborador.funcionario.remove')
	->with('funcionario', $funcionario);
}

public function destroy($idFuncionario)
{	
	$funcionario = \DB::table('funcionario')->where('id_funcionario','=', $idFuncionario)->first();

	\DB::delete('DELETE FROM funcionario WHERE id_funcionario ='.$idFuncionario);
	\DB::delete('DELETE FROM pessoa_fisica WHERE id_parte ='.$funcionario->id_parte);
	\DB::delete('DELETE FROM parte WHERE id_parte ='.$funcionario->id_parte);

	flash()->success('Funcionario Excluído com Sucesso!');
	return redirect('/funcionario/');
}
}