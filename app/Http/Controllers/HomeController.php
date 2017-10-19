<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
    	$datas =  \DB::table('etapa_processo')
        ->join('etapa', 'etapa.id_etapa','=', 'etapa_processo.id_etapa')
    	->orderBy('dt_prazo','asc')
    	->whereDate('dt_prazo','>=', date('Y-m-d'))
    	//->where('dt_prazo', '=', NULL)
		->limit(9)
		->get();


		$num = count($datas);

		return view('layouts.dashboard')
		->with('datas', $datas)
		->with('num', $num);
    }

    public function agenda()
    {
    	$etapas =  \DB::table('etapa_processo')
    	->join('processo','processo.id_processo','etapa_processo.id_processo')
        ->join('etapa', 'etapa.id_etapa','etapa_processo.id_etapa')
    	->get();

    	return view('etapa.agenda')
    	->with('etapas', $etapas);
    }
}
