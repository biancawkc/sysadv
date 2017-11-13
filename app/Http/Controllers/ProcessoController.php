<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Redirect;
use File;
use Auth;
use Illuminate\Support\Facades\DB;

class ProcessoController extends Controller
{
	public function index()
	{
		$processos =  \DB::table('processo')
		->join('estado_processo','estado_processo.id_estado_processo', '=', 'processo.id_estado_processo')
		->get();

		return view('processo.index')
		->with('processos', $processos);
	}

	public function verify()
	{   
		$msg="";
		return view('processo.verify')
		->with('msg', $msg);
	}


	public function create(Request $request)
	{   
		$advogados = \DB::table('advogado')
		->join('pessoa_fisica', 'advogado.id_parte', '=', 'pessoa_fisica.id_parte')
		->get();

		$pessoaJuridica =  \DB::table('pessoa_juridica')
		->join('parte', 'pessoa_juridica.id_parte', '=', 'parte.id_parte')
		->where('parte.ativo', '=', 1)
		->get();

		$pessoaFisica = \DB::table('pessoa_fisica')
		->join('parte', 'pessoa_fisica.id_parte', '=', 'parte.id_parte')
		->where('parte.ativo', '=', 1)
		->get();

		$comarcas = \DB::table('comarca')->get();
		$justicas = \DB::table('justica')->get();
		$varas = \DB::table('vara')->get();
		$num = $request->numero;
		$msg = "";
		$processo = \DB::table('processo')->where('numero', $num)->first();

		if(is_null($processo))
		{
			return view('processo.create')
			->with('advogados', $advogados)
			->with('pessoaFisica', $pessoaFisica)
			->with('pessoaJuridica', $pessoaJuridica)
			->with('num', $num)
			->with('comarcas', $comarcas)
			->with('justicas', $justicas)
			->with('varas', $varas);
		}
		else
		{	
			$msg = "Este número de processo já foi cadastrado!";
			return view('processo.verify')
			->with('msg', $msg);
		}
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'numero' => 'required|max:15|unique:processo,numero',
			'desc_processo' => 'required|max:2000',
			'nome_acao' => 'required|max:100',
			'dt_inicio' => 'required',
			'id_estado_processo' =>'required'
		]);
		if ($validator->fails()) {
			return redirect('processo/create')
			->withErrors($validator)
			->withInput();
		} else {

			$processo = new \App\Models\Processo();

			$usuario = \App\Models\Usuario::where('username', '=', Auth::user()->username)->value('id_usuario');

			$processo->numero = $request->numero;
			$processo->desc_processo = $request->desc_processo;
			$processo->nome_acao = $request->nome_acao;
			$processo->justica_grat = $request->justica_grat;
			$processo->acao_grat = $request->acao_grat;
			$processo->id_justica = $request->id_justica;
			$processo->id_estado_processo = $request->id_estado_processo;
			$processo->id_comarca = $request->id_comarca;
			$processo->id_advogado = $request->id_advogado;
			$processo->id_vara = $request->id_vara;	
			$processo->id_usuario = $usuario;

			$str = $request->dt_inicio;
			$data = explode("/", $str);
			$data = $data[2] . "-" . $data[1] . "-" . $data[0];
			$processo->dt_inicio = new \DateTime($data);

			if(!is_null($request->dt_final))
			{
				$str2 = $request->dt_final;
				$date = explode("/", $str2);
				$date = $date[2] . "/" . $date[1] . "/" . $date[0];
				$processo->dt_final = new \DateTime($date);
			}

			$processo->save();

				foreach ($request->id_parte  as $ind => $val) {

					if(!empty($val)){
						$parteProcesso = new \App\Models\ParteTemProcesso();
						$parteProcesso->id_parte = $val;
						$parteProcesso->id_processo = $processo->getAttribute("id_processo");
						$parteProcesso->participacao = $request->participacao[$ind];
/*						$parteProcesso->id_responsavel = $request->id_responsavel[$ind];
*/						$parteProcesso->save();
					}
				}
			
			flash()->success('Cadastro Inserido com Sucesso!');
			return redirect('/processo/');
		}
	}

	public function show($id)
	{
		$processo = \App\Models\Processo::find($id);

		$vara = \App\Models\Vara::find($processo->id_vara);

		$usuario = \App\Models\Usuario::find($processo->id_usuario);

		$idComarca = \DB::table('processo')->where('id_processo', $id)->value('id_comarca');
		$comarca = \App\Models\Comarca::find($idComarca);

		$idJustica = \DB::table('processo')->where('id_processo', $id)->value('id_justica');
		$justica = \App\Models\Justica::find($idJustica);

		$idEstadoProcesso = \DB::table('processo')->where('id_processo', $id)->value('id_estado_processo');
		$estadoProcesso = \App\Models\EstadoProcesso::find($idEstadoProcesso);

				$pessoaJuridicaC = NULL;

				$pessoaJuridicaC = DB::select("SELECT parte_tem_processo.*, 
					pessoa_juridica.*, 
					endereco.*,
					parte.*,
					( SELECT GROUP_CONCAT(telefone.telefone SEPARATOR ' / ') 
					FROM telefone 
					INNER JOIN pessoa_juridica 
					ON 
					telefone.id_parte = pessoa_juridica.id_parte 
					WHERE parte_tem_processo.id_parte = pessoa_juridica.id_parte )
					AS telefones 
					FROM parte_tem_processo 
					INNER JOIN pessoa_juridica
					ON pessoa_juridica.id_parte = parte_tem_processo.id_parte
					LEFT JOIN endereco
					ON endereco.id_parte = parte_tem_processo.id_parte
					INNER JOIN parte
					ON parte.id_parte = parte_tem_processo.id_parte
					WHERE parte_tem_processo.id_processo LIKE '$id'
					AND parte_tem_processo.participacao LIKE 'c'

					");


				$pessoaFisicaC = NULL;

				$pessoaFisicaC = DB::select("SELECT parte_tem_processo.*, 
					pessoa_fisica.*, 
					endereco.*,
					parte.*,
					( SELECT GROUP_CONCAT(telefone.telefone SEPARATOR ' / ') 
					FROM telefone 
					INNER JOIN pessoa_fisica 
					ON 
					telefone.id_parte = pessoa_fisica.id_parte 
					WHERE parte_tem_processo.id_parte = pessoa_fisica.id_parte )
					AS telefones ,
					(SELECT estado_civil.desc_estado_civil FROM estado_civil
					INNER JOIN pessoa_fisica ON 
					estado_civil.id_estado_civil = pessoa_fisica.id_estado_civil
					WHERE parte_tem_processo.id_parte = pessoa_fisica.id_parte)
					AS estados,
					(SELECT profissao.nm_profissao FROM profissao
					INNER JOIN pessoa_fisica ON 
					profissao.id_profissao = pessoa_fisica.id_profissao
					WHERE parte_tem_processo.id_parte = pessoa_fisica.id_parte)
					AS profis,
					(SELECT profissao.cbo FROM profissao
					INNER JOIN pessoa_fisica ON 
					profissao.id_profissao = pessoa_fisica.id_profissao
					WHERE parte_tem_processo.id_parte = pessoa_fisica.id_parte)
					AS cbo
					FROM parte_tem_processo 
					INNER JOIN pessoa_fisica
					ON pessoa_fisica.id_parte = parte_tem_processo.id_parte
					LEFT JOIN endereco
					ON endereco.id_parte = parte_tem_processo.id_parte
					INNER JOIN parte
					ON parte.id_parte = parte_tem_processo.id_parte
					WHERE parte_tem_processo.id_processo LIKE '$id'
					AND parte_tem_processo.participacao LIKE 'c'

					");


                            	$pessoaJuridicaA = NULL;

                            	$pessoaJuridicaA = DB::select("SELECT parte_tem_processo.*, 
                            		pessoa_juridica.*, 
                            		endereco.*,
                            		parte.*,
                            		( SELECT GROUP_CONCAT(telefone.telefone SEPARATOR ' / ') 
                            		FROM telefone 
                            		INNER JOIN pessoa_juridica 
                            		ON 
                            		telefone.id_parte = pessoa_juridica.id_parte 
                            		WHERE parte_tem_processo.id_parte = pessoa_juridica.id_parte )
                            		AS telefones 
                            		FROM parte_tem_processo 
                            		INNER JOIN pessoa_juridica
                            		ON pessoa_juridica.id_parte = parte_tem_processo.id_parte
                            		LEFT JOIN endereco
                            		ON endereco.id_parte = parte_tem_processo.id_parte
                            		INNER JOIN parte
                            		ON parte.id_parte = parte_tem_processo.id_parte
                            		WHERE parte_tem_processo.id_processo LIKE '$id'
                            		AND parte_tem_processo.participacao LIKE 'a'

                            		");


                            	$pessoaFisicaA = NULL;

                            	$pessoaFisicaA = DB::select("SELECT parte_tem_processo.*, 
                            		pessoa_fisica.*, 
                            		endereco.*,
                            		parte.*,
                            		( SELECT GROUP_CONCAT(telefone.telefone SEPARATOR ' / ') 
                            		FROM telefone 
                            		INNER JOIN pessoa_fisica 
                            		ON 
                            		telefone.id_parte = pessoa_fisica.id_parte 
                            		WHERE parte_tem_processo.id_parte = pessoa_fisica.id_parte )
                            		AS telefones ,
                            		(SELECT estado_civil.desc_estado_civil FROM estado_civil
                            		INNER JOIN pessoa_fisica ON 
                            		estado_civil.id_estado_civil = pessoa_fisica.id_estado_civil
                            		WHERE parte_tem_processo.id_parte = pessoa_fisica.id_parte)
                            		AS estados,
                            		(SELECT profissao.nm_profissao FROM profissao
                            		INNER JOIN pessoa_fisica ON 
                            		profissao.id_profissao = pessoa_fisica.id_profissao
                            		WHERE parte_tem_processo.id_parte = pessoa_fisica.id_parte)
                            		AS profis,
                            		(SELECT profissao.cbo FROM profissao
                            		INNER JOIN pessoa_fisica ON 
                            		profissao.id_profissao = pessoa_fisica.id_profissao
                            		WHERE parte_tem_processo.id_parte = pessoa_fisica.id_parte)
                            		AS cbo
                            		FROM parte_tem_processo 
                            		INNER JOIN pessoa_fisica
                            		ON pessoa_fisica.id_parte = parte_tem_processo.id_parte
                            		LEFT JOIN endereco
                            		ON endereco.id_parte = parte_tem_processo.id_parte
                            		INNER JOIN parte
                            		ON parte.id_parte = parte_tem_processo.id_parte
                            		WHERE parte_tem_processo.id_processo LIKE '$id'
                            		AND parte_tem_processo.participacao LIKE 'a'

                            		");

                   
                            	return view('processo.show')
                            	->with('processo', $processo)
                            	->with('comarca', $comarca)
                            	->with('justica', $justica)
                            	->with('pessoaFisicaC', $pessoaFisicaC)
                            	->with('pessoaJuridicaC', $pessoaJuridicaC)
                            	->with('pessoaFisicaA', $pessoaFisicaA)
                            	->with('pessoaJuridicaA', $pessoaJuridicaA)
                            	->with('estadoProcesso', $estadoProcesso)
                            	->with('usuario', $usuario)
                            	->with('vara', $vara);
                            }

                            public function edit($id)
                            {
                            	$processo = \App\Models\Processo::find($id);
                            	$usuario = \App\Models\Usuario::find($processo->id_usuario);

                            	if(!is_null($processo->dt_final))
                            	{
                            		$dt_final = date('d/m/Y', strtotime($processo->dt_final));
                            	}else
                            	{
                            		$dt_final = "";
                            	}


                            	$varas = \DB::table('vara')->get();
                            	$status = \DB::table('estado_processo')->get();

                            	$idEstadoProcesso = \DB::table('processo')->where('id_processo', $id)->value('id_estado_processo');
                            	$estadoProcesso = \App\Models\EstadoProcesso::find($idEstadoProcesso);

                            	$advogados = \DB::table('advogado')
                            	->join('pessoa_fisica', 'advogado.id_parte', '=', 'pessoa_fisica.id_parte')
                            	->get();

                            	$pessoaJuridica =  \DB::table('pessoa_juridica')
                            	->join('parte', 'pessoa_juridica.id_parte', '=', 'parte.id_parte')
                            	->where('parte.ativo', '=', 1)
                            	->get();

                            	$pessoaFisica = \DB::table('pessoa_fisica')
                            	->join('parte', 'pessoa_fisica.id_parte', '=', 'parte.id_parte')
                            	->where('parte.ativo', '=', 1)
                            	->get();

                            	$comarcas = \DB::table('comarca')->get();
                            	$justicas = \DB::table('justica')->get();

                            	$partes = \DB::table('parte_tem_processo')
                            	->where('parte_tem_processo.id_processo', '=', $id)
                            	->get();

                            	$pessoaJuridicaC = \DB::table('parte_tem_processo')
                            	->join('pessoa_juridica', 'parte_tem_processo.id_parte', '=', 'pessoa_juridica.id_parte')
                            	->where([
                            		['parte_tem_processo.id_processo', '=', $id],
                            		['parte_tem_processo.participacao', '=', 'c'],
                            	])->get();

                            	$pessoaFisicaC = \DB::table('parte_tem_processo')
                            	->join('pessoa_fisica', 'parte_tem_processo.id_parte', '=', 'pessoa_fisica.id_parte')
                            	->where([
                            		['parte_tem_processo.id_processo', '=', $id],
                            		['parte_tem_processo.participacao', '=', 'c'],
                            	])->get();

                            	$pessoaJuridicaA = \DB::table('parte_tem_processo')
                            	->join('pessoa_juridica', 'parte_tem_processo.id_parte', '=', 'pessoa_juridica.id_parte')
                            	->where([
                            		['parte_tem_processo.id_processo', '=', $id],
                            		['parte_tem_processo.participacao', '=', 'a'],
                            	])->get();

                            	$pessoaFisicaA = \DB::table('parte_tem_processo')
                            	->join('pessoa_fisica', 'parte_tem_processo.id_parte', '=', 'pessoa_fisica.id_parte')
                            	->where([
                            		['parte_tem_processo.id_processo', '=', $id],
                            		['parte_tem_processo.participacao', '=', 'a'],
                            	])->get();


                            	return view('processo.edit')
                            	->with('processo', $processo)
                            	->with('pessoaFisicaC', $pessoaFisicaC)
                            	->with('pessoaJuridicaC', $pessoaJuridicaC)
                            	->with('pessoaFisicaA', $pessoaFisicaA)
                            	->with('pessoaJuridicaA', $pessoaJuridicaA)
                            	->with('estadoProcesso', $estadoProcesso)
                            	->with('advogados', $advogados)
                            	->with('pessoaFisica', $pessoaFisica)
                            	->with('pessoaJuridica', $pessoaJuridica)
                            	->with('comarcas', $comarcas)
                            	->with('justicas', $justicas)
                            	->with('varas', $varas)
                            	->with('dt_final', $dt_final)
                            	->with('status', $status)
                            	->with('usuario', $usuario);
                            }

                            public function update(Request $request, $id)
                            {
                            	$validator = Validator::make($request->all(), [
                            		'numero' => 'required|max:15',
                            		'desc_processo' => 'required|max:2000',
                            		'nome_acao' => 'required|max:100',
                            		'dt_inicio' => 'required',
                            		//'id_estado_processo' =>'required'
                            	]);
                            	if ($validator->fails()) {
                            		return redirect('processo/create')
                            		->withErrors($validator)
                            		->withInput();
                            	} else {

                            		$processo = \App\Models\Processo::find($id);
                            		$usuario = \App\Models\Usuario::where('username', '=', Auth::user()->username)->value('id_usuario');

                            		$processo->numero = $request->numero;
                            		$processo->desc_processo = $request->desc_processo;
                            		$processo->nome_acao = $request->nome_acao;
                            		$processo->justica_grat = $request->justica_grat;
                            		$processo->acao_grat = $request->acao_grat;
                            		$processo->id_vara = $request->id_vara;
                            		$processo->id_justica = $request->id_justica;
                            		$processo->id_estado_processo = $request->id_estado_processo;
                            		$processo->id_comarca = $request->id_comarca;
                            		$processo->id_advogado = $request->id_advogado;
                            		$processo->id_usuario = $usuario;

                            		$str = $request->dt_inicio;
                            		$data = explode("/", $str);
                            		$data = $data[2] . "-" . $data[1] . "-" . $data[0];
                            		$processo->dt_inicio = new \DateTime($data);

                            		if(!is_null($request->dt_final))
                            		{
                            		$str2 = $request->dt_final;
                            		$date = explode("/", $str2);
                            		$date = $date[2] . "/" . $date[1] . "/" . $date[0];
                            		$processo->dt_final = new \DateTime($date);
                            		}
                            		$processo->save();

                            		\DB::delete('DELETE FROM parte_tem_processo WHERE id_processo ='.$id);

                            		foreach ($request->id_parte  as $ind => $val) {
                            			if(!empty($val)){
                            				$parteProcesso = new \App\Models\ParteTemProcesso();
                            				$parteProcesso->id_parte = $val;
                            				$parteProcesso->id_processo = $processo->getAttribute("id_processo");
                            				$parteProcesso->participacao = $request->participacao[$ind];
                            				$parteProcesso->save();
                            			}
                            		}

                            		flash()->success('Dados Atualizados com Sucesso!');
                            		return redirect()->back();

                            	}

                            }

                            public function remove($id)
                            {
                            	$processo = \App\Models\Processo::find($id);
                            	return view('processo.remove')
                            	->with('processo', $processo);
                            }


                            public function destroy($id)
                            {
                            	\DB::delete('DELETE FROM parte_tem_processo WHERE id_processo ='.$id);

                            	$documento = \DB::table('documento')
                            	->where('id_processo','=', $id)
                            	->get();

                            	if(!empty($documento))
                            	{
                            		foreach ($documento as $value) {
                            			$doc = $value->documento;
                            			$path = base_path().'/public/documento/'.$doc;
                            			File::delete($path);
                            		}
                            	}

                            	\DB::delete('DELETE FROM documento WHERE id_processo ='.$id);
                            	\DB::delete('DELETE FROM etapa_processo WHERE id_processo ='.$id);
                            	\DB::delete('DELETE FROM parcela WHERE id_processo ='.$id);

                            	$processo = \App\Models\Processo::find($id);
                            	$processo->delete();

                            }

                        }
