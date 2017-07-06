<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Redirect;

class ProcessoController extends Controller
{
	public function index()
	{
		 $processos =  \DB::table('processo')
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

		$partes = \DB::table('pessoa_fisica')
		->join('parte', 'pessoa_fisica.id_parte', '=', 'parte.id_parte')
		->where('parte.ativo', '=', 1)
		->get();

		$comarcas = \DB::table('comarca')->get();
		$justicas = \DB::table('justica')->get();
		$num = $request->numero;
		$msg = "";
		$processo = \DB::table('processo')->where('numero', $num)->first();

		if(is_null($processo))
		{
			return view('processo.create')
			->with('advogados', $advogados)
			->with('partes', $partes)
			->with('num', $num)
			->with('comarcas', $comarcas)
			->with('justicas', $justicas);
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
			'numero' => 'required|max:15',
			'desc_processo' => 'required|max:2000',
			'nome_acao' => 'required|max:10',
			'dt_inicio' => 'required',
			'id_estado_processo' =>'required'
			]);
		if ($validator->fails()) {
			return redirect('processo/create')
			->withErrors($validator)
			->withInput();
		} else {
			
			$processo = new \App\Models\Processo();

			$processo->numero = $request->numero;
			$processo->desc_processo = $request->desc_processo;
			$processo->nome_acao = $request->nome_acao;
			$processo->justica_grat = $request->justica_grat;
			$processo->acao_grat = $request->acao_grat;
			$processo->vara = $request->vara;
			$processo->dt_inicio = $request->dt_inicio;
			$processo->dt_final = $request->dt_final;
			$processo->id_justica = $request->id_justica;
			$processo->id_estado_processo = $request->id_estado_processo;
			$processo->id_comarca = $request->id_comarca;
			$processo->id_advogado = $request->id_advogado;
			$processo->save();

			foreach ($request->id_parte  as $ind => $val) {
				if(!empty($val)){
					$parteProcesso = new \App\Models\ParteTemProcesso();
					$parteProcesso->id_parte = $val;
					$parteProcesso->id_processo = $processo->getAttribute("id_processo");
					$parteProcesso->participacao = $request->participacao[$ind];
					$parteProcesso->save();
				}
			}


			flash()->success('Cadastro Inserido com Sucesso!');
			return redirect('/processo/create');

		}
	}
}
