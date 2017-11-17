<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Redirect;
use File;
use Response;

class DocumentoController extends Controller
{
	public function index($idProcesso)
	{
		$documentos =  \DB::table('documento')
		->where('id_processo', $idProcesso)
		->get();

		$processo = \DB::table('processo')
		->join('justica', 'processo.id_justica', '=', 'justica.id_justica')
		->join('comarca', 'processo.id_comarca', '=', 'comarca.id_comarca')
		->join('vara', 'processo.id_vara', '=', 'vara.id_vara')
		->join('estado_processo', 'estado_processo.id_estado_processo', '=', 'processo.id_estado_processo')
		->where('id_processo', $idProcesso)
		->first();

		return view('documento.index')
		->with('documentos', $documentos)
		->with('idProcesso', $idProcesso)
		->with('processo', $processo);
	}

	public function create($idProcesso)
	{	
		return view ('documento.create')
		->with('idProcesso', $idProcesso);
	}

	public function store (Request $request, $idProcesso)
	{
		$validator = Validator::make($request->all(), [
			'nome_documento' => 'required|max:150',
			'documento' => 'required|mimes:pdf,jpeg,png'
		]);
		if ($validator->fails()) {
			return redirect('documento/'.$idProcesso.'/create')
			->withErrors($validator)
			->withInput();
		} else {
			
			$documento = new \App\Models\Documento();

			if($request->hasFile('documento')) {

				$file = Input::file('documento');

				$timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
				$name = $timestamp. '-' .$file->getClientOriginalName();

				$nome = trim($name,'');
				//$nomeArquivo = $usuario. '_'.$nome ;
				$request->file('documento')->getClientOriginalExtension();

				$request->file('documento')->move(
					base_path() . '/public/documento/', $nome
				);

				$documento->documento = $nome;
			}


			$documento->nome_documento = $request->nome_documento;
			$documento->desc_documento = $request->desc_documento;
			$documento->id_processo = $idProcesso;
			$documento->save();
		}
		flash()->success('Cadastro Inserido com Sucesso!');
		return redirect('documento/'.$idProcesso);
	}

	public function edit($id)
	{
		$documento = \App\Models\Documento::find($id);

		return view ('documento.edit')
		->with('documento', $documento);
	}

	public function update(Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
			'nome_documento' => 'required|max:150'
		]);
		if ($validator->fails()) {
			return redirect('documento/'.$id.'/edit')
			->withErrors($validator)
			->withInput();
		} else {
			
			$documento = \App\Models\Documento::find($id);

			if($request->hasFile('documento')) {

				$path = base_path().'/public/documento/'.$documento->documento;
				File::delete($path);

				$documento->delete();

				$file = Input::file('documento');

				$timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
				$name = $timestamp. '-' .$file->getClientOriginalName();

				$nome = trim($name,'');
				//$nomeArquivo = $usuario. '_'.$nome ;
				$request->file('documento')->getClientOriginalExtension();

				$request->file('documento')->move(
					base_path() . '/public/documento/', $nome
				);

				$documento->documento = $nome;

			}

			$documento->nome_documento = $request->nome_documento;
			$documento->desc_documento = $request->desc_documento;
			$documento->save();
		}
		flash()->success('Cadastro Editado com Sucesso!');
		return redirect('documento/'.$id.'/edit');
	}

	public function remove($id)
	{
		$documento = \App\Models\Documento::find($id);
		$processo = \App\Models\Processo::find($documento->id_processo)->value('numero');

		return view('documento.remove')
		->with('documento', $documento)
		->with('processo', $processo);
	}

	public function destroy($id)
	{
		$documento = \App\Models\Documento::find($id);
		$processo = $documento->id_processo;

		$path = base_path().'/public/documento/'.$documento->documento;
		File::delete($path);

		$documento->delete();

		flash()->success('Documento Excluído com Sucesso!');
		return redirect('documento/'.$processo);
	}

}
