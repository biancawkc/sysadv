<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Redirect;

class PessoaFisicaController extends Controller
{
	public function create(Request $request)
	{  
		$cpf = $request->cpf;
		/*$rne = $request->rne;
		$rg = $request->rg;
		$pass = $request->passaporte;*/
		
		$civil = \App\Models\EstadoCivil::all(['desc_estado_civil', 'id_estado_civil']);
		$tp_tel = \App\Models\TipoTel::all(['tp_telefone', 'id_tp_telefone']);
		$profissao = \DB::table('profissao')->get();

		$result = \DB::table('pessoa_fisica')->where('cpf', $cpf)->first();

		$msg = "";

		if(is_null($result))
		{
			return view('pessoa.pessoaFisica.create')
			->with('cpf', $cpf)
			->with('civil', $civil)
			->with('tp_tel', $tp_tel)
			->with('profissao', $profissao);
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
			'cpf' => 'required|max:13|unique:pessoa_fisica,cpf',
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
			return redirect('pessoaFisica/create')
			->withErrors($validator)
			->withInput();
		} else {
			
			$endereco = new \App\Models\Endereco();
			$pessoaFisica = new \App\Models\PessoaFisica();
			$parte = new \App\Models\Parte();
			$telefone = new \App\Models\Telefone();

			$parte->ativo = $request->ativo;
			$parte->email = $request->email;
			$parte->save();

			$pessoaFisica->id_parte = $parte->getAttribute("id_parte");
			$pessoaFisica->nome = $request->nome;
			$pessoaFisica->rg = $request->rg;
			$pessoaFisica->orgao_exp = $request->orgao_exp;
			$pessoaFisica->cpf = $request->cpf;
			$pessoaFisica->id_estado_civil = $request->id_estado_civil;
			$pessoaFisica->ctps = $request->ctps;
			$pessoaFisica->remuneracao = $request->remuneracao;
			$pessoaFisica->id_profissao = $request->id_profissao;

			$str = $request->dt_nasc;
            $data = explode("/", $str);
            $data = $data[2] . "-" . $data[1] . "-" . $data[0];
            $pessoaFisica->dt_nasc = new \DateTime($data);
			$pessoaFisica->save();

			$endereco->cep = $request->cep;
			$endereco->logradouro = $request->logradouro;
			$endereco->complemento = $request->complemento;
			$endereco->bairro = $request->bairro;
			$endereco->uf = $request->uf;
			$endereco->cidade = $request->cidade;
			$endereco->numero = $request->numero;
			$endereco->id_parte = $parte->getAttribute("id_parte");
			$endereco->save();

			foreach ($request->telefone  as $ind => $value) {
				if(!empty($value)){
					$telefone =  new \App\Models\Telefone();
					$telefone->telefone = $value;
					$telefone->id_parte = $parte->getAttribute("id_parte");
					$telefone->id_tp_telefone = $request->id_tp_telefone[$ind];
					$telefone-> save();
				}
			}

			flash()->success('Cadastro Inserido com Sucesso!');
			return redirect('/pessoa/');

		}
	}

	function review($id)
	{
		$civil = \App\Models\EstadoCivil::all(['desc_estado_civil', 'id_estado_civil']);
		$tp_tel = \App\Models\TipoTel::all(['tp_telefone', 'id_tp_telefone']);
		$pessoaFisica = \DB::table('pessoa_fisica')->where('id_parte','=', $id)->first();
		$parte =  \App\Models\Parte::find($id);
		$e = $pessoaFisica->id_estado_civil;
		$dtNasc = date('d/m/Y', strtotime($pessoaFisica->dt_nasc));
		return view('pessoa.pessoaFisica.review')
		->with('civil', $civil)
		->with('tp_tel', $tp_tel)
		->with('pessoaFisica', $pessoaFisica)
		->with('parte', $parte)
		->with('e', $e)
		->with('dtNasc', $dtNasc);
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

			\App\Models\Parte::where('id_parte', '=', $id)
			->update(['email' => $request->email]);

			\App\Models\Parte::where('id_parte', '=', $id)
			->update(['ativo' => $request->ativo]);

			$str = $request->dt_nasc;
			$data = explode("/", $str);
			$data = $data[2] . "-" . $data[1] . "-" . $data[0];

			\App\Models\PessoaFisica::where('id_parte', '=', $id)
			->update(['nome' =>$request->nome,
					  'rg' => $request->rg,
					  'id_estado_civil' => $request->id_estado_civil,
					  'orgao_exp' => $request->orgao_exp,
					  'dt_nasc' => $data,
					  'ctps' => $request->ctps,
					]);

			$endereco->cep = $request->cep;
			$endereco->logradouro = $request->logradouro;
			$endereco->complemento = $request->complemento;
			$endereco->bairro = $request->bairro;
			$endereco->uf = $request->uf;
			$endereco->cidade = $request->cidade;
			$endereco->numero = $request->numero;
			$endereco->id_parte = $id;
			$endereco->save();

			$prof = $profissao->$request->id_profissao;

			\App\Models\PessoaFisica::where('id_parte', '=', $id)
			->update(['id_profissao' => $prof]);

				foreach ($request->telefone  as $ind => $value) {
				if(!empty($value)){
					$telefone =  new \App\Models\Telefone();
					$telefone->telefone = $value;
					$telefone->id_parte = $parte->getAttribute("id_parte");
					$telefone->id_tp_telefone = $request->id_tp_telefone[$ind];
					$telefone-> save();
				}
			}


			flash()->success('Cadastro Inserido com Sucesso!');
			return redirect('pessoaFisica/'.$id.'/review');
		}
	}

	function edit($id)
	{	
		$civil = \App\Models\EstadoCivil::all(['desc_estado_civil', 'id_estado_civil']);
		$tp_tel = \App\Models\TipoTel::all(['tp_telefone', 'id_tp_telefone']);

		$idEndereco = \DB::table('endereco')->where('id_parte','=', $id)->value('id_endereco');
		
		$telefone =  \DB::table('telefone')
		->join('tp_telefone', 'telefone.id_tp_telefone','=', 'tp_telefone.id_tp_telefone')
		->where('telefone.id_parte','=', $id)
		->get();

		$pessoaFisica = \DB::table('pessoa_fisica')->where('id_parte','=', $id)->first();
		$profissao = \DB::table('profissao')->get();
		$endereco =  \App\Models\Endereco::find($idEndereco);
		$parte =  \App\Models\Parte::find($id);

		$numTel = count($telefone);

		$dtNasc = date('d/m/Y', strtotime($pessoaFisica->dt_nasc));

		return view('pessoa.pessoaFisica.edit')
		->with('civil', $civil)
		->with('tp_tel', $tp_tel)
		->with('pessoaFisica', $pessoaFisica)
		->with('parte', $parte)
		->with('endereco', $endereco)
		->with('telefone', $telefone)
		->with('profissao',$profissao)
		->with('dtNasc', $dtNasc)
		->with('numTel', $numTel);
	}

	function update(Request $request, $id)
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
			return redirect('pessoaFisica/'.$id.'/edit')
			->withErrors($validator)
			->withInput();
		} else {

			\App\Models\Parte::where('id_parte', '=', $id)
			->update(['email' => $request->email]);

			$str = $request->dt_nasc;
			$data = explode("/", $str);
			$data = $data[2] . "-" . $data[1] . "-" . $data[0];

			\DB::table('pessoa_fisica')
			->where('id_parte','=', $id)
			->update([
				'nome' => $request->nome,
				'orgao_exp' => $request->orgao_exp,
				'cpf' => $request->cpf,
				'rg' => $request->rg,
				'dt_nasc' => $data,
				'ctps' => $request->ctps,
				'id_estado_civil' => $request->id_estado_civil,
				'remuneracao' => $request->remuneracao,
				'id_profissao' => $request->id_profissao				
				]);

			\DB::table('endereco')
			->where('id_parte','=', $id)
			->update([
				'cep' => $request->cep,
				'logradouro' => $request->logradouro,
				'complemento' => $request->complemento,
				'bairro' => $request->bairro,
				'uf' => $request->uf,
				'cidade' => $request->cidade,
				'numero' => $request->numero
				]);

				\DB::delete('DELETE FROM telefone WHERE id_parte ='.$id);

				foreach ($request->telefone  as $ind => $value) {
				if(!empty($value)){
					$telefone =  new \App\Models\Telefone();
					$telefone->telefone = $value;
					$telefone->id_parte = $id;
					$telefone->id_tp_telefone = $request->id_tp_telefone[$ind];
					$telefone-> save();
				}
			}

			flash()->success('Dados Alterados com Sucesso!');
			return redirect('pessoaFisica/'.$id.'/edit');
		}
	}

	public function show($id)
	{	
		$idEndereco = \DB::table('endereco')->where('id_parte','=', $id)->value('id_endereco');
		/*$idTel = \DB::table('telefone')->where('id_parte','=', $id)->value('id_telefone');*/

		$pessoaFisica = \DB::table('pessoa_fisica')->where('id_parte','=', $id)->first();
		$endereco = \App\Models\Endereco::where('id_parte', $id)->first();
		$parte =  \App\Models\Parte::find($id);

		$telefone =  \DB::table('telefone')
		->join('tp_telefone', 'telefone.id_tp_telefone','=', 'tp_telefone.id_tp_telefone')
		->where('telefone.id_parte','=', $id)
		->get();

		$profissao = \DB::table('profissao')->where('id_profissao','=', $pessoaFisica->id_profissao)->first();

		$civil = \App\Models\EstadoCivil::find($pessoaFisica->id_estado_civil);

		return view('pessoa.pessoaFisica.show')
		->with('civil', $civil)
		->with('pessoaFisica', $pessoaFisica)
		->with('parte', $parte)
		->with('endereco', $endereco)
		->with('telefone', $telefone)
		->with('profissao',$profissao);
	}

	public function remove($id)
	{
		$pessoaFisica = \DB::table('pessoa_fisica')->where('id_parte','=', $id)->first();

		$processo = \DB::table('parte_tem_processo')->where('id_parte','=', $id)->first();

		if(is_null($processo))
		{
			return view('pessoa.pessoaFisica.remove')
			->with('pessoaFisica', $pessoaFisica);
		}
		else
		{
			flash()->overlay('Não é possível deletar os dados de '.$pessoaFisica->nome.', pois está vinculado com pelo menos um processo.','Atenção');
			return redirect('pessoaFisica/'.$id.'/show');
		}
	}
	

	public function destroy($id)
	{
		$pessoaFisica = \DB::table('pessoa_fisica')->where('id_parte','=', $id)->first();
		
		\DB::delete('DELETE FROM endereco WHERE id_parte ='.$id);
		\DB::delete('DELETE FROM telefone WHERE id_parte ='.$id);
		\DB::delete('DELETE FROM pessoa_fisica WHERE id_parte ='.$id);
		\DB::delete('DELETE FROM parte WHERE id_parte ='.$id);

		flash()->success('Pessoa Física Excluída com Sucesso!');
		return redirect('pessoa/');
	}


}
