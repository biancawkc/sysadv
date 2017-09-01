<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade as PDF;
use Redirect;
use NumberFormatter;

class ParcelaController extends Controller
{	
	public function index($idProcesso)
	{
		$processo = \DB::table('processo')
		->where('id_processo', $idProcesso)
		->first();

		$parcela = \DB::table('parcela')
		->where('id_processo', $idProcesso)
		->get();

		return view('parcela.index')
		->with('processo', $processo)
		->with('parcela', $parcela)
		->with('idProcesso', $idProcesso);
	}

	public function create($idProcesso)
	{	
		$formaPag = \DB::table('forma_pag')->get();

		return view ('parcela.create')
		->with('idProcesso', $idProcesso)
		->with('formaPag', $formaPag);
	}

	public function store (Request $request, $idProcesso)
	{
		$validator = Validator::make($request->all(), [
			'dt_venc'=>'required'
			]);
		if ($validator->fails()) {
			return redirect('parcela/'.$idProcesso.'/create')
			->withErrors($validator)
			->withInput();
		} else {

			$consulta = \DB::table('parcela')
			->where('id_processo', $idProcesso)
			->orderBy('id_parcela', 'desc')
			->first();

			if(!empty($consulta->num_parcela))
			{
				$first = (int)$consulta->num_parcela + 1;
			}
			else
			{
				$first = 1;
			}
			
			$dv =  $request->num_parcelas;
			$d =   $dv - 1;
			/*$valores = $request->total/$dv;
			$valor = round($valores, 2 ,  PHP_ROUND_HALF_UP);*/
			
			$i = 1;

			$parcela = new \App\Models\Parcela();

			$parcela->num_parcela = $first;
			$parcela->valor = $request->valor;
			$parcela->id_processo = $idProcesso;
			$parcela->id_forma_pag = $request->id_forma_pag;
			$parcela->id_tp_parcela = $request->id_tp_parcela;
			$parcela->porcentagem = $request->porcentagem;

			$str = $request->dt_venc;
            $data = explode("/", $str);
            $data = $data[2] . "-" . $data[1] . "-" . $data[0];
            $parcela->dt_venc = new \DateTime($data);
			$parcela->save();

			for($j = $d; $i <= $j; $i++ )
			{	
				$parcela = new \App\Models\Parcela();

				$str = $request->dt_venc;
				$data = explode("/", $str);
				$data = $data[2] . "-" . $data[1] . "-" . $data[0];

				$time = strtotime($data);
				$date = strtotime('+'.$i.' month', $time);
				$dt_venc = date("Y-m-d", $date);
				$first++;

				$parcela->num_parcela = $first;
				$parcela->valor = $request->valor;
				$parcela->dt_venc = $dt_venc;
				$parcela->id_processo = $idProcesso;
				$parcela->id_forma_pag = $request->id_forma_pag;
				$parcela->id_tp_parcela = $request->id_tp_parcela;
				$parcela->porcentagem = $request->porcentagem;
				$parcela->save();
			}	

			flash()->success('Parcela(s) Inserido(s) com Sucesso!');
			return redirect('parcela/'.$idProcesso);
		}
	}

	public function edit($id)
	{	
		$parcela = \App\Models\Parcela::find($id);
		$formaPag = \DB::table('forma_pag')->get();
		if($parcela->dt_pag !== "")
		{
			$pag = date('d/m/Y', strtotime($parcela->pag));
		}
		else
		{
			$pag = "";
		}
		return view ('parcela.edit')
		->with('formaPag', $formaPag)
		->with('parcela', $parcela)
		->with('pag', $pag);	
	}

	public function update (Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
			'dt_venc'=>'required'
			]);
		if ($validator->fails()) {
			return redirect('parcela/'.$id.'/edit')
			->withErrors($validator)
			->withInput();
		} else {
			
			$parcela = \App\Models\Parcela::find($id);

			$parcela->num_parcela = $request->num_parcela;
			$parcela->valor = $request->valor;
			$parcela->id_forma_pag = $request->id_forma_pag;
			$parcela->id_tp_parcela = $request->id_tp_parcela;

			$str = $request->dt_venc;
			$data = explode("/", $str);
			$data = $data[2] . "-" . $data[1] . "-" . $data[0];
			$parcela->dt_venc = new \DateTime($data);

			if($request->dt_pag !== "")
			{
			$str2 = $request->dt_pag;
			$date = explode("/", $str2);
			$date = $date[2] . "-" . $date[1] . "-" . $date[0];
			$parcela->dt_pag = new \DateTime($date);
			}
			$parcela->save();

		}

		flash()->success('Parcela Atualizada com Sucesso!');
		return redirect('parcela/'.$id.'/edit');
	}

	public function recibo($id)
	{	
		$html = "";
		$html = $this->montarRecibo($id);
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($html);
		return $pdf->stream();
	}

	public function montarRecibo($id)
	{	
		$html = "";
		$parcela = \App\Models\Parcela::find($id);
		$idProcesso = $parcela->id_processo;
		$processo = \App\Models\Processo::find($idProcesso);

		$clienteJurid = \DB::table('parte_tem_processo')
		->join('pessoa_juridica', 'parte_tem_processo.id_parte', '=', 'pessoa_juridica.id_parte')
		->where([
			['parte_tem_processo.id_processo', '=', $idProcesso],
			['parte_tem_processo.participacao', '=', 'c'],
			])->get();

		$clienteFis = \DB::table('parte_tem_processo')
		->join('pessoa_fisica', 'parte_tem_processo.id_parte', '=', 'pessoa_fisica.id_parte')
		->where([
			['parte_tem_processo.id_processo', '=', $idProcesso],
			['parte_tem_processo.participacao', '=', 'c'],
			])->get();

		$fis="";
		$jurid="";

		
		if(!empty($clienteJurid))
		{	
			$iMax = count($clienteJurid)-1;
			foreach ($clienteJurid as $i=>$CJ) {
				$jurid .= $CJ->razao_social;

				if($iMax-$i-1 == 0 && $iMax > 0 && empty($clienteFis)) {
					$jurid .= " e ";
				}elseif(!empty($clienteFis)){
					$jurid .= ", ";
				}
			}
		} 
		
		if (!empty($clienteFis)) {
			$xMax = count($clienteFis)-1;
			foreach ($clienteFis as $x=>$CF) {
				$fis .= $CF->nome;
				if($xMax-$x-1 == 0 && $xMax > 0) {
					$fis .= " e ";
				}elseif($xMax-$x > 0){
					$fis .= ", ";
				}
			}
		}

		$f = new NumberFormatter("pt_BR", NumberFormatter::SPELLOUT);
		$valor = ucfirst($f->format($parcela->valor));
		
		$decimal = substr_count($parcela->valor,'.');
		if($decimal == 1)
		{
			$separa = explode('.',$parcela->valor);
			$valores = ucfirst($f->format($separa[0]))." reais e ".$f->format($separa[1])." centavos";
		}elseif ($decimal == 0) {
			$valores = $valor." reais";
		}

		setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
		date_default_timezone_set('America/Sao_Paulo');

		return view('parcela.recibo')
		->with('parcela', $parcela)
		->with('valores', $valores)
		->with('jurid', $jurid)
		->with('fis', $fis)
		->with('processo', $processo);
	}

}
