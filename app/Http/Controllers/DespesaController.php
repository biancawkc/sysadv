<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Redirect;
use Auth;

class DespesaController extends Controller
{	
	public function index($idProcesso)
	{
		$despesa =  \DB::table('despesa')
		->where('id_processo', $idProcesso)
		->get();

		$processo = \DB::table('processo')
		->join('justica', 'processo.id_justica', '=', 'justica.id_justica')
		->join('comarca', 'processo.id_comarca', '=', 'comarca.id_comarca')
		->join('vara', 'processo.id_vara', '=', 'vara.id_vara')
		->join('estado_processo', 'estado_processo.id_estado_processo', '=', 'processo.id_estado_processo')
		->where('id_processo', $idProcesso)
		->first();

		return view('despesa.index')
		->with('despesa', $despesa)
		->with('idProcesso', $idProcesso)
		->with('processo', $processo);
	}

	public function create($idProcesso)
	{	
		return view ('despesa.create')
		->with('idProcesso', $idProcesso);
	}

	public function store (Request $request, $idProcesso)
	{
		$validator = Validator::make($request->all(), [
			'valor' => 'required',
			'desc_despesa' => 'required|max:150',
			'dt_despesa' => 'required'
			]);
		if ($validator->fails()) {
			return redirect('despesa/'.$idProcesso.'/create')
			->withErrors($validator)
			->withInput();
		} else {
			
			$despesa = new \App\Models\Despesa();
			$usuario = \App\Models\Usuario::where('username', '=', Auth::user()->username)->value('id_usuario');

			$despesa->valor = $request->valor;
			$despesa->id_processo = $idProcesso;
			$despesa->desc_despesa = $request->desc_despesa;
			$despesa->id_usuario = $usuario;

			$str = $request->dt_despesa;
			$data = explode("/", $str);
			$data = $data[2] . "-" . $data[1] . "-" . $data[0];
			$despesa->dt_despesa = new \DateTime($data);
			$despesa->save();
		}


		flash()->success('Cadastro Inserido com Sucesso!');
		return redirect('despesa/'.$idProcesso);
	}

	public function edit($id)
	{	
		$despesa = \App\Models\Despesa::find($id);
		$valores = number_format($despesa->valor,2,",",".");
		$usuario = \App\Models\Usuario::find($despesa->id_usuario);

		return view ('despesa.edit')
		->with('despesa', $despesa)
		->with('valores', $valores)
		->with('usuario', $usuario);
	}

	public function update (Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
			'valor' => 'required',
			'desc_despesa' => 'required|max:150',
			'dt_despesa' => 'required'
			]);
		if ($validator->fails()) {
			return redirect('despesa/'.$id.'/edit')
			->withErrors($validator)
			->withInput();
		} else {
			
			$despesa = \App\Models\Despesa::find($id);
			$usuario = \App\Models\Usuario::where('username', '=', Auth::user()->username)->value('id_usuario');

			$despesa->valor = $request->valor;
			$despesa->desc_despesa = $request->desc_despesa;
			$despesa->id_usuario = $request->id_usuario;
			
			$str = $request->dt_despesa;
			$data = explode("/", $str);
			$data = $data[2] . "-" . $data[1] . "-" . $data[0];
			$despesa->dt_despesa = new \DateTime($data);
			$despesa->save();
		}


		flash()->success('Dados Alterados com Sucesso!');
		return redirect('despesa/'.$id.'/edit');
	}

	public function remove($id)
	{
		$despesa = \App\Models\Despesa::find($id);
		$processo = \App\Models\Processo::find($despesa->id_processo)->value('numero');

		return view('despesa.remove')
			->with('despesa', $despesa)
			->with('processo', $processo);
	}

	public function destroy($id)
	{
		$despesa = \App\Models\Despesa::find($id);
		$processo = $despesa->id_processo;
		$despesa->delete();

		flash()->success('Despesa Excluída com Sucesso!');
		return redirect('despesa/'.$processo);
	}
}
