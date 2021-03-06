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
		->join('etapa', 'etapa.id_etapa','=', 'etapa_processo.id_etapa')
		->where('id_processo', $idProcesso)
		->get();

		$processo = \DB::table('processo')
		->join('justica', 'processo.id_justica', '=', 'justica.id_justica')
		->join('comarca', 'processo.id_comarca', '=', 'comarca.id_comarca')
		->join('vara', 'processo.id_vara', '=', 'vara.id_vara')
		->join('estado_processo', 'estado_processo.id_estado_processo', '=', 'processo.id_estado_processo')
		->where('id_processo', $idProcesso)
		->first();

		$nmEtapas = \DB::table('etapa')->get();

		$nmEtapasE = \DB::table('etapa')->where('nm_etapa','LIKE', '%Estadual%')->get();

		$nmEtapasF = \DB::table('etapa')->where('nm_etapa','LIKE', '%Federal%')->get();

		$strEtapa = explode(' ',strtolower($processo->nm_justica));

		return view('etapa.index')
		->with('etapas', $etapas)
		->with('idProcesso', $idProcesso)
		->with('processo', $processo)
		->with('nmEtapas', $nmEtapas)
		->with('nmEtapasE', $nmEtapasE)
		->with('nmEtapasF', $nmEtapasF)
		->with('strEtapa', $strEtapa);

	}

	public function create($idProcesso)
	{	$nmEtapas = \DB::table('etapa')->get();
	return view ('etapa.create')
	->with('idProcesso', $idProcesso)
	->with('nmEtapas',$nmEtapas);
}

public function store (Request $request, $idProcesso)
{
	$validator = Validator::make($request->all(), [
		'id_etapa' => 'required',
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

		$etapa->id_etapa = $request->id_etapa;
		$etapa->desc_etapa = $request->desc_etapa;
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

	$nmEtapa = \App\Models\Etapa::where('id_etapa','=',$etapa->id_etapa)->value('nm_etapa');

	$processo = \DB::table('processo')
		->join('justica', 'processo.id_justica', '=', 'justica.id_justica')
		->join('comarca', 'processo.id_comarca', '=', 'comarca.id_comarca')
		->join('vara', 'processo.id_vara', '=', 'vara.id_vara')
		->join('estado_processo', 'estado_processo.id_estado_processo', '=', 'processo.id_estado_processo')
		->where('id_processo', $etapa->id_processo)
		->first();

	return view ('etapa.show')
	->with('etapa', $etapa)
	->with('processo', $processo)
	->with('nmEtapa',$nmEtapa);
}

public function edit($id)
{	
	$etapa = \App\Models\EtapaProcesso::find($id);
	$nmEtapas = \DB::table('etapa')->get();

	return view ('etapa.edit')
	->with('etapa', $etapa)
	->with('nmEtapas', $nmEtapas);
}

public function update (Request $request, $id)
{
	$validator = Validator::make($request->all(), [
		'id_etapa' => 'required',
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

		$etapa->id_etapa = $request->id_etapa;
		$etapa->desc_etapa = $request->desc_etapa;

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
	$nomeEtapa = \App\Models\Etapa::find($etapa->id_etapa);
	$processo = \App\Models\Processo::find($etapa->id_processo)->value('numero');

	return view('etapa.remove')
	->with('etapa', $etapa)
	->with('nomeEtapa', $nomeEtapa)
	->with('processo', $processo);
}

public function destroy($id)
{
	$etapa = \App\Models\EtapaProcesso::find($id);
	$processo = $etapa->id_processo;
	$etapa->delete();

	flash()->success('Etapa Exclu??da com Sucesso!');
	return redirect('etapa/'.$processo);

}

}
