<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::group(['middleware' => 'usuario_guest'], function() {

Route::get('/', 'UsuarioAuth\LoginController@showLoginForm');
Route::post('/login', 'UsuarioAuth\LoginController@login');

Route::get('password/reset', 'UsuarioAuth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'UsuarioAuth\ForgotPasswordController@sendResetLinkEmail');

Route::get('password/reset/{token}', 'UsuarioAuth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'UsuarioAuth\ResetPasswordController@reset');

Route::get('cadastrar_usuario', 'UsuarioAuth\RegisterController@showRegistrationForm');
Route::post('cadastrar_usuario', 'UsuarioAuth\RegisterController@register');

});

/*Route::group(['middleware' => 'admin'], function () { 


});*/

Route::group(['middleware' => 'usuario_auth'], function(){

Route::post('logout', 'UsuarioAuth\LoginController@logout');

Route::get('/home', function(){
  return view('layouts.dashboard');
});


Route::get('/despesa', function(){
  return view('despesa.create');
});

Route::get('/documento', function(){
  return view('documento.create');
});

Route::get('/honorarios', function(){
  return view('parcela.honorario.create');
});
Route::get('/ganhoCausa', function(){
  return view('parcela.ganhoCausa.create');
});

Route::get('/master3', function(){
  return view('layouts.dashboard2');
});

/*Route::get('/adm', function(){
  return view('layouts.dashboard');
});*/
 

Route::get('colaborador/verify', ['as' => 'funcionario.verify', 'uses' => 'FuncionarioController@verify']);
Route::group(['prefix' => 'funcionario'], function(){

  Route::get('/', ['as' => 'funcionario.index', 'uses' => 'FuncionarioController@index']);
  Route::get('/create', ['as' => 'funcionario.add', 'uses' => 'FuncionarioController@create']);

  Route::post('/addColab', ['as' => 'funcionario.addColab', 'uses' => 'FuncionarioController@create']);
  Route::post('/add', ['as' => 'funcionario.store', 'uses' => 'FuncionarioController@store']);

  Route::get('{id}/review', ['as' => 'funcionario.review', 'uses' => 'FuncionarioController@review']);
  Route::post('{id}/review', ['as' => 'funcionario.updateReview','uses' => 'FuncionarioController@updateReview']);
 /* Route::get('{id}/edit', ['as' => 'funcionario.edit', 'uses' => 'FuncionarioController@edit']);
  Route::put('{id}/edit', ['as' => 'funcionario.update','uses' => 'FuncionarioController@update']);
  Route::get('{id}/remove', ['as' => 'funcionario.remove', 'uses' => 'FuncionarioController@remove']f);
  Route::post('{id}/remove', ['as' => 'funcionario.destroy','uses' => 'FuncionarioController@destroy']);
  Route::get('{id}/show', ['as' => 'funcionario.show', 'uses' => 'FuncionarioController@show']);*/  
});

Route::group(['prefix' => 'advogado'], function(){

  Route::get('/', ['as' => 'advogado.index', 'uses' => 'AdvogadoController@index']);
  Route::get('/create', ['as' => 'advogado.add', 'uses' => 'AdvogadoController@create']);

  Route::post('/addColab', ['as' => 'advogado.addColab', 'uses' => 'AdvogadoController@create']);
  Route::post('/add', ['as' => 'advogado.store', 'uses' => 'AdvogadoController@store']);

  Route::get('{id}/review', ['as' => 'advogado.review', 'uses' => 'AdvogadoController@review']);
  Route::post('{id}/review', ['as' => 'advogado.updateReview','uses' => 'AdvogadoController@updateReview']);
 /* Route::get('{id}/edit', ['as' => 'funcionario.edit', 'uses' => 'FuncionarioController@edit']);
  Route::put('{id}/edit', ['as' => 'funcionario.update','uses' => 'FuncionarioController@update']);
  Route::get('{id}/remove', ['as' => 'funcionario.remove', 'uses' => 'FuncionarioController@remove']f);
  Route::post('{id}/remove', ['as' => 'funcionario.destroy','uses' => 'FuncionarioController@destroy']);
  Route::get('{id}/show', ['as' => 'funcionario.show', 'uses' => 'FuncionarioController@show']);*/
});

 Route::get('pessoa/verify', ['as' => 'pessoa.verify', 'uses' => 'PessoaFisicaController@verify']);
 Route::get('pessoa/', ['as' => 'pessoa.index', 'uses' => 'PessoaFisicaController@index']);

 Route::group(['prefix' => 'pessoaFisica'], function(){

  Route::get('/pessoa', ['as' => 'fisica.add', 'uses' => 'PessoaFisicaController@create']);
  Route::post('/addPessoa', ['as' => 'fisica.addPerson', 'uses' => 'PessoaFisicaController@create']);
  Route::post('/add', ['as' => 'fisica.store', 'uses' => 'PessoaFisicaController@store']);

  Route::get('{id}/review', ['as' => 'fisica.review', 'uses' => 'PessoaFisicaController@review']);
  Route::post('{id}/review', ['as' => 'fisica.updateReview','uses' => 'PessoaFisicaController@updateReview']);

  Route::get('{id}/edit', ['as' => 'fisica.edit', 'uses' => 'PessoaFisicaController@edit']);
/*  Route::put('{id}/edit', ['as' => 'fisica.update','uses' => 'PessoaFisicaController@update']);*/

  /*Route::get('{id}/remove', ['as' => 'funcionario.remove', 'uses' => 'FuncionarioController@remove']f);
  Route::post('{id}/remove', ['as' => 'funcionario.destroy','uses' => 'FuncionarioController@destroy']);
  Route::get('{id}/show', ['as' => 'funcionario.show', 'uses' => 'FuncionarioController@show']);*/
});


Route::group(['prefix' => 'pessoaJuridica'], function(){

  Route::get('/create', ['as' => 'jurid.add', 'uses' => 'PessoaJuridaController@create']);
  Route::post('/addPessoa', ['as' => 'jurid.addPerson', 'uses' => 'PessoaJuridController@create']);
  Route::post('/add', ['as' => 'jurid.store', 'uses' => 'PessoaJuridController@store']);
 /* Route::get('{id}/edit', ['as' => 'funcionario.edit', 'uses' => 'FuncionarioController@edit']);
  Route::put('{id}/edit', ['as' => 'funcionario.update','uses' => 'FuncionarioController@update']);
  Route::get('{id}/remove', ['as' => 'funcionario.remove', 'uses' => 'FuncionarioController@remove']f);
  Route::post('{id}/remove', ['as' => 'funcionario.destroy','uses' => 'FuncionarioController@destroy']);
  Route::get('{id}/show', ['as' => 'funcionario.show', 'uses' => 'FuncionarioController@show']);*/
 
});

Route::group(['prefix' => 'processo'], function(){
  Route::get('/', ['as' => 'processo.index', 'uses' => 'ProcessoController@index']);
  Route::get('/verify', ['as' => 'processo.verify', 'uses' => 'ProcessoController@verify']);
  Route::get('/create', ['as' => 'processo.add', 'uses' => 'ProcessoController@create']);
  Route::post('/addProcesso', ['as' => 'processo.addProcesso', 'uses' => 'ProcessoController@create']);
  Route::post('/add', ['as' => 'processo.store', 'uses' => 'ProcessoController@store']);
 /* Route::get('{id}/edit', ['as' => 'funcionario.edit', 'uses' => 'FuncionarioController@edit']);
  Route::put('{id}/edit', ['as' => 'funcionario.update','uses' => 'FuncionarioController@update']);
  Route::get('{id}/remove', ['as' => 'funcionario.remove', 'uses' => 'FuncionarioController@remove']f);
  Route::post('{id}/remove', ['as' => 'funcionario.destroy','uses' => 'FuncionarioController@destroy']);
  Route::get('{id}/show', ['as' => 'funcionario.show', 'uses' => 'FuncionarioController@show']);*/
  
});
Route::group(['prefix' => 'etapa'], function(){
    Route::get('/{idProcesso}', ['as' => 'processo.index', 'uses' => 'EtapaController@index']);
    Route::get('{idProcesso}/create', ['as' => 'etapa.create', 'uses' => 'EtapaController@create']);
    Route::post('{idProcesso}/add', ['as' => 'etapa.store', 'uses' => 'EtapaController@store']);
});

Route::group(['prefix' => 'documento'], function(){
    Route::get('/{idProcesso}', ['as' => 'documento.index', 'uses' => 'DocumentoController@index']);
    Route::get('{idProcesso}/create', ['as' => 'documento.create', 'uses' => 'DocumentoController@create']);
    Route::post('{idProcesso}/add', ['as' => 'documento.store', 'uses' => 'DocumentoController@store']);

    Route::get('{$id}/showDoc', ['as' => 'documento.show', 'uses' => 'DocumentoController@showDoc']);
});

});
