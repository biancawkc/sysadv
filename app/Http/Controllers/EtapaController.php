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
			$etapa->id_processo = $idProcesso;

			$str = $request->dt_etapa;
			$data = explode("/", $str);
			$data = $data[2] . "-" . $data[1] . "-" . $data[0];
			$etapa->dt_etapa = new \DateTime($data);

			$str2 = $request->dt_prazo;
			$date = explode("/", $str2);
			$date = $date[2] . "-" . $date[1] . "-" . $date[0];
			$etapa->dt_prazo = new \DateTime($date);

			$etapa->save();
		}
		flash()->success('Cadastro Inserido com Sucesso!');
		return redirect('etapa/'.$idProcesso);
	}

	public function show($id)
	{	
		$etapa = \App\Models\EtapaProcesso::find($id);
		$processo = \App\Models\Processo::where('id_processo','=',$etapa->id_processo)->value('numero');

		return view ('etapa.show')
		->with('etapa', $etapa)
		->with('processo', $processo);
	}

	public function edit($id)
	{	
		$etapa = \App\Models\EtapaProcesso::find($id);

		return view ('etapa.edit')
		->with('etapa', $etapa);
	}

	public function update (Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
			'nome' => 'required|max:150',
			'desc_etapa' => 'required|max:500',
			'dt_etapa' => 'required',
			'dt_prazo' => 'required'
			]);
		if ($validator->fails()) {
			return redirect('etapa/'.$id.'/edit')
			->withErrors($validator)
			->withInput();
		} else {
			
			$etapa = \App\Models\EtapaProcesso::find($id);

			$etapa->nome = $request->nome;
			$etapa->desc_etapa = $request->desc_etapa;
			$etapa->instancia = $request->instancia;
			
			$str = $request->dt_etapa;
			$data = explode("/", $str);
			$data = $data[2] . "-" . $data[1] . "-" . $data[0];
			$etapa->dt_etapa = new \DateTime($data);

			$str2 = $request->dt_prazo;
			$date = explode("/", $str2);
			$date = $date[2] . "-" . $date[1] . "-" . $date[0];
			$etapa->dt_prazo = new \DateTime($date);
			$etapa->save();
		}
		
		flash()->success('Etapa Alterada com Sucesso!');
		return redirect()->back();
	}

	public function remove($id)
	{
		$etapa = \App\Models\EtapaProcesso::find($id);

		return view('etapa.remove')
			->with('etapa', $etapa);
	}

	public function destroy($id)
	{
		$etapa = \App\Models\EtapaProcesso::find($id);
		$processo = $etapa->id_processo;
		$etapa->delete();

		flash()->success('Etapa Excluída com Sucesso!');
		return redirect('etapa/'.$processo);

	}

}
