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
		return view('documento.index')
		->with('documentos', $documentos)
		->with('idProcesso', $idProcesso);
	}

	public function create($idProcesso)
	{	
		//$idProcesso = $request->id_processo;
		//return Redirect::to( $idProcesso.'/documento');
		//$processo = \App\Models\Processo::find($idProcesso);
		return view ('documento.create')
		->with('idProcesso', $idProcesso);
	}

	public function store (Request $request, $idProcesso)
	{
		$validator = Validator::make($request->all(), [
			'nome_documento' => 'required|max:150',
			'documento' => 'required|mimes:pdf'
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
			//$documento->documento = $request->documento;
			$documento->id_processo = $idProcesso;
			$documento->save();
		}
		flash()->success('Cadastro Inserido com Sucesso!');
		return redirect('documento/'.$idProcesso.'/create');
	}


	public function showDoc($id)
	{
		$documento = \App\Models\Documento::find($id);

		$doc = $documento->documento;

		$path = base_path().'/public/documento/'.$doc;
		header("Content-Length: " . filesize ( $path ) ); 
		header("Content-type: application/pdf"); 
		header("Content-disposition: inline; filename=".basename($path));
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		ob_clean();
		flush();
		readfile($path);

	}

}
