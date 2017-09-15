<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Redirect;

class RelatorioController extends Controller
{
	public function relatorio($idProcesso)
	{	

		$html = "";
		$html = $this->montarRelatorio($idProcesso);
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($html);
		return $pdf->stream();
	}

	public function montarRelatorio($idProcesso)
	{	
		$html ="";
		$processo = "";
		$processo = \App\Models\Processo::find($idProcesso);


		$parcelaH = DB::table('parcela')
		->where([
			['parcela.id_processo', '=', $idProcesso],
			['parcela.id_tp_parcela', '=', 1],
			])->get();

		$parcelaHsum = DB::table('parcela')
		->where([
			['parcela.id_processo', '=', $idProcesso],
			['parcela.id_tp_parcela', '=', 1],
			['parcela.dt_pag', '<>', NULL],
			])->sum('valor');

		$parcelaRece = DB::table('parcela')
		->where([
			['parcela.id_processo', '=', $idProcesso],
			['parcela.id_tp_parcela', '=', 1],
			['parcela.dt_pag', '=', NULL],
			])->sum('valor');

		$parcelaHtotal = DB::table('parcela')
		->where([
			['parcela.id_processo', '=', $idProcesso],
			['parcela.id_tp_parcela', '=', 1],
			])->sum('valor');

		$parcelaG = DB::table('parcela')
		->where([
			['parcela.id_processo', '=', $idProcesso],
			['parcela.id_tp_parcela', '=', 2],
			])->get();

		$parcelaGsum = DB::table('parcela')
		->where([
			['parcela.id_processo', '=', $idProcesso],
			['parcela.id_tp_parcela', '=', 2],
			['parcela.dt_pag', '<>', NULL],
			])->sum('valor');

		$parcelaGRece = DB::table('parcela')
		->where([
			['parcela.id_processo', '=', $idProcesso],
			['parcela.id_tp_parcela', '=', 2],
			['parcela.dt_pag', '=', NULL],
			])->sum('valor');

		$parcelaGtotal = DB::table('parcela')
		->where([
			['parcela.id_processo', '=', $idProcesso],
			['parcela.id_tp_parcela', '=', 2],
			])->sum('valor');

		$despesa =  DB::table('despesa')
		->where('id_processo', $idProcesso)
		->get();

		$etapa =  DB::table('etapa_processo')
		->where('id_processo', $idProcesso)
		->get();

		 $despesaTotal = DB::table('despesa')
		 ->where('id_processo', $idProcesso)->sum('valor');

		 $idComarca = DB::table('processo')->where('id_processo', $idProcesso)->value('id_comarca');
		 $comarca = \App\Models\Comarca::find($idComarca);

		 $idJustica = DB::table('processo')->where('id_processo', $idProcesso)->value('id_justica');
		 $justica = \App\Models\Justica::find($idJustica);

		 $idEstadoProcesso = DB::table('processo')->where('id_processo', $idProcesso)->value('id_estado_processo');
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
			WHERE parte_tem_processo.id_processo LIKE '$idProcesso'
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
			WHERE parte_tem_processo.id_processo LIKE '$idProcesso'
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
			WHERE parte_tem_processo.id_processo LIKE '$idProcesso'
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
			WHERE parte_tem_processo.id_processo LIKE '$idProcesso'
			AND parte_tem_processo.participacao LIKE 'a'

			");

		return View::make('relatorio.relatorio', compact(['processo', 'estadoProcesso', 'comarca', 'justica','pessoaJuridicaC', 'pessoaFisicaC','pessoaFisicaA', 'pessoaJuridicaA',  'parcelaH', 'parcelaG', 'parcelaHsum', 'parcelaRece', 'parcelaHtotal', 'parcelaGsum', 'parcelaGRece', 'parcelaGtotal', 'despesa','despesaTotal','etapa']));
		/*return view('relatorio.relatorio')
		->with('processo', $processo);*/
		// ->with('comarca', $comarca)
		// ->with('justica', $justica)
		// ->with('pessoaFisicaC', $pessoaFisicaC)
		// ->with('pessoaJuridicaC', $pessoaJuridicaC)
		// ->with('pessoaFisicaA', $pessoaFisicaA)
		// ->with('pessoaJuridicaA', $pessoaJuridicaA)
		// ->with('estadoProcesso', $estadoProcesso)
		// ->with('parcelaH', $parcelaH);
	}

}
