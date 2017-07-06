<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Redirect;

class EtapaController extends Controller
{	

	public function index($idProcesso)
	{
		$etapas =  \DB::table('etapa_processo')
		->where('id_processo', $idProcesso)
		->get();
		return view('etapa.index')
				->with('etapas', $etapas)
				->with('idProcesso', $idProcesso);
	}

    public function create($idProcesso)
	{	
		//$idProcesso = $request->id_processo;
		//return Redirect::to( $idProcesso.'/etapa');
		//$processo = \App\Models\Processo::find($idProcesso);
		return view ('etapa.create')
		->with('idProcesso', $idProcesso);
	}

	public function store (Request $request, $idProcesso)
	{
	$validator = Validator::make($request->all(), [
			'nome' => 'required|max:150',
			'desc_etapa' => 'required|max:500',
			'dt_etapa' => 'required',
			'dt_prazo' => 'required'
			]);
		if ($validator->fails()) {
			return redirect('etapa/'.$idProcesso.'/create')
			->withErrors($validator)
			->withInput();
		} else {
			
			$etapa = new \App\Models\EtapaProcesso();

			$etapa->nome = $request->nome;
			$etapa->desc_etapa = $request->desc_etapa;
			$etapa->instancia = $request->instancia;
			$etapa->dt_etapa = $request->dt_etapa;
			$etapa->dt_prazo = $request->dt_prazo;
			$etapa->id_processo = $idProcesso;
			$etapa->save();
		}
		flash()->success('Cadastro Inserido com Sucesso!');
			return redirect('etapa/'.$idProcesso.'/create');
}

}
