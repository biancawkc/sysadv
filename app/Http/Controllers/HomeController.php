<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
    	$datas =  \DB::table('etapa_processo')
    	->orderBy('dt_etapa','asc')
    	->whereDate('dt_etapa','<=', $date = date('Y-m-d'))
    	->where('dt_prazo', '=', NULL)
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
    	->get();

    	return view('etapa.agenda')
    	->with('etapas', $etapas);
    }
}
