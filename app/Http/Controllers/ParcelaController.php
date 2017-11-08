<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade as PDF;
use Redirect;
use NumberFormatter;
use Auth;

class ParcelaController extends Controller
{	
	public function index($idProcesso)
	{
		$processo = \DB::table('processo')
		->join('justica', 'processo.id_justica', '=', 'justica.id_justica')
		->join('comarca', 'processo.id_comarca', '=', 'comarca.id_comarca')
		->join('vara', 'processo.id_vara', '=', 'vara.id_vara')
		->join('estado_processo', 'estado_processo.id_estado_processo', '=', 'processo.id_estado_processo')
		->where('id_processo', $idProcesso)
		->first();

		$parcela = \DB::table('parcela')
		->where('id_processo', $idProcesso)
		->get();
		
		$formaPag = \DB::table('forma_pag')->get();

		return view('parcela.index')
		->with('processo', $processo)
		->with('parcela', $parcela)
		->with('idProcesso', $idProcesso)
		->with('formaPag', $formaPag);
	}

	public function create_f($idProcesso)
	{	

		$formaPag = \DB::table('forma_pag')->get();

		return view ('parcela.create')
		->with('idProcesso', $idProcesso)
		->with('formaPag', $formaPag);
	}

	public function create(Request $request, $idProcesso)
	{
		$primeira = $request->primeira;
		$demais = $request->demais;
		$forma = $request->id_forma_pag;
		$tipo = $request->id_tp_parcela;
		$porcentagem = $request->porcentagem;
		$qtd = $request->num_parcelas;
		$juros = $request->juros;
		$str = $request->dt_venc;
		$valor_acao = $request->valor_acao;
		$i = 1;

		$data = explode("/", $str);
		$data = $data[2] . "-" . $data[1] . "-" . $data[0];

		return view('parcela.show_parcelas')
		->with('primeira', $primeira)
		->with('demais', $demais)
		->with('forma', $forma)
		->with('tipo', $tipo)
		->with('porcentagem', $porcentagem)
		->with('qtd', $qtd)
		->with('idProcesso', $idProcesso)
		->with('data', $data)
		->with('i', $i)
		->with('data', $data)
		->with('juros', $juros)
		->with('valor_acao', $valor_acao);
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

			\DB::table('processo')
			->where('id_processo','=', $idProcesso)
			->update([
				'valor_acao' => $request->valor_acao				
				]);

			$parcela = new \App\Models\Parcela();
			$usuario = \App\Models\Usuario::where('username', '=', Auth::user()->username)->value('id_usuario');

			$parcela->num_parcela = $first;
			$parcela->adversa_pag = 0;
			$parcela->valor = $request->primeira;
			$parcela->juros = $request->juros;
			$parcela->id_processo = $idProcesso;
			$parcela->id_forma_pag = $request->id_forma_pag;
			$parcela->id_tp_parcela = $request->id_tp_parcela;
			$parcela->id_usuario = $usuario;
			$parcela->porcentagem = $request->porcentagem;

			/*$str = $request->dt_venc;
            $data = explode("/", $str);
            $data = $data[2] . "-" . $data[1] . "-" . $data[0];*/
            $parcela->dt_venc = $request->dt_venc;
			$parcela->save();

			for($j = $d; $i <= $j; $i++ )
			{	
				$parcela = new \App\Models\Parcela();

				/*$str = $request->dt_venc;
				$data = explode("/", $str);
				$data = $data[2] . "-" . $data[1] . "-" . $data[0];*/

				$time = strtotime($request->dt_venc);
				$date = strtotime('+'.$i.' month', $time);
				$dt_venc = date("Y-m-d", $date);
				$first++;

				$parcela->num_parcela = $first;
				$parcela->adversa_pag = 0;
				$parcela->valor = $request->valor;
				$parcela->juros = $request->juros;
				$parcela->dt_venc = $dt_venc;
				$parcela->id_processo = $idProcesso;
				$parcela->id_forma_pag = $request->id_forma_pag;
				$parcela->id_tp_parcela = $request->id_tp_parcela;
				$parcela->porcentagem = $request->porcentagem;
				$parcela->id_usuario = $usuario;
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
		$valores = number_format($parcela->valor,2,",",".");

		$processo = \DB::table('processo')
		->join('justica', 'processo.id_justica', '=', 'justica.id_justica')
		->join('comarca', 'processo.id_comarca', '=', 'comarca.id_comarca')
		->join('vara', 'processo.id_vara', '=', 'vara.id_vara')
		->join('estado_processo', 'estado_processo.id_estado_processo', '=', 'processo.id_estado_processo')
		->where('id_processo', $parcela->id_processo)
		->first();
		$usuario = \App\Models\Usuario::find($parcela->id_usuario);

		if(!is_null($parcela->dt_pag))
		{
			$pag = date('d/m/Y', strtotime($parcela->dt_pag));
		}
		else
		{
			$pag = "";
		}

		if(is_null($parcela->multa))
		{
			$multa = 0;
		}
		elseif(!is_null($parcela->multa))
		{
			$multa = $parcela->multa;
		}

		if(is_null($parcela->desconto))
		{
			$desconto = 0;
		}
		elseif (!is_null($parcela->desconto)) {
			$desconto = $parcela->desconto;
		}

		$valorF = (float)$parcela->valor + $multa - $desconto;

		return view ('parcela.edit')
		->with('formaPag', $formaPag)
		->with('parcela', $parcela)
		->with('pag', $pag)
		->with('valorF', $valorF)
		->with('valores', $valores)
		->with('processo', $processo)
		->with('usuario', $usuario);	
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
			$usuario = \App\Models\Usuario::where('username', '=', Auth::user()->username)->value('id_usuario');

			$parcela->num_parcela = $request->num_parcela;
			$parcela->valor = $request->valor;
			if($request->adversa_pag != 1)
			{
				$parcela->adversa_pag = 0;
			}
			else
			{
			$parcela->adversa_pag = 1;
			}
			$parcela->juros = $request->juros;
			$parcela->desconto = $request->desconto;
			$parcela->dias_atraso = $request->dias_atraso;
			$parcela->multa = $request->multa;
			$parcela->id_forma_pag = $request->id_forma_pag;
			$parcela->id_tp_parcela = $request->id_tp_parcela;
			$parcela->id_usuario = $usuario;

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

		$adversaJurid = \DB::table('parte_tem_processo')
		->join('pessoa_juridica', 'parte_tem_processo.id_parte', '=', 'pessoa_juridica.id_parte')
		->where([
			['parte_tem_processo.id_processo', '=', $idProcesso],
			['parte_tem_processo.participacao', '=', 'a'],
			])->get();

		$adversaFis = \DB::table('parte_tem_processo')
		->join('pessoa_fisica', 'parte_tem_processo.id_parte', '=', 'pessoa_fisica.id_parte')
		->where([
			['parte_tem_processo.id_processo', '=', $idProcesso],
			['parte_tem_processo.participacao', '=', 'a'],
			])->get();

		$countAdvJur = $adversaJurid->count();
		$countAdvFis = $adversaFis->count();

		$fis="";
		$jurid="";
		$fisA="";
		$juridA="";
		$multa="";
		$desconto="";

		if(is_null($parcela->multa))
		{
			$multa = 0;
		}
		elseif(!is_null($parcela->multa))
		{
			$multa = $parcela->multa;
		}

		if(is_null($parcela->desconto))
		{
			$desconto = 0;
		}
		elseif (!is_null($parcela->desconto)) {
			$desconto = $parcela->desconto;
		}

		$valorF = (float)$parcela->valor + $multa - $desconto;
		
		if($parcela->adversa_pag == 1)
		{
			if(!empty($adversaJurid))
		{	
			$iMaxA = count($adversaJurid)-1;
			foreach ($adversaJurid as $a=>$AJ) {
				$juridA .= $AJ->razao_social;

				if($iMaxA-$a-1 == 0 && $iMaxA > 0 && empty($adversaFis)) {
					$juridA .= " e ";
				}elseif($countAdvFis > 1){
					$juridA .= ", ";
				}elseif($iMaxA-$a-1 > 0){
					$juridA .= ", ";
				}
			}
		} 
		
		if (!empty($adversaFis)) {
			$xMaxa = count($adversaFis)-1;
			foreach ($adversaFis as $y=>$AF) {
				$fisA .= $AF->nome;
				if($xMaxa-$y-1 == 0 && $xMaxa > 0) {
					$fisA .= " e ";
				}elseif($xMaxa-$y > 0){
					$fisA .= ", ";
				}
			}
		}

		}
		elseif($parcela->adversa_pag == 0)
		{
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
	 }
		$f = new NumberFormatter("pt_BR", NumberFormatter::SPELLOUT);
		$valor = ucfirst($f->format($valorF));
		
		$decimal = substr_count($valorF,'.');
		if($decimal == 1)
		{
			$separa = explode('.',$valorF);
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
		->with('juridA', $juridA)
		->with('fisA', $fisA)
		->with('processo', $processo)
		->with('valorF', $valorF)
		->with('countAdvJur', $countAdvJur);
	}

}
