<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
    	$datas =  \DB::table('etapa_processo')
		->limit(9)
		->get();

		return view('layouts.dashboard')
		->with('datas', $datas);
    }
}
