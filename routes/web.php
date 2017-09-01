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
  });

  Route::group(['middleware' => 'usuario_auth'], function(){

    Route::post('logout', 'UsuarioAuth\LoginController@logout');

    Route::get('home', 'HomeController@index');

      Route::get('/r', function(){
      return view('colaborador.te');
    });

    Route::group(['middleware' => 'admin'], function () { 

       Route::get('cadastrar_usuario/{idPessoa}', 'UsuarioAuth\RegisterController@showRegistrationForm');
        Route::get('cadastrar_usuario/', 'UsuarioAuth\RegisterController@showRegisterForm');
        Route::post('cadastrar_usuario/', 'UsuarioAuth\RegisterController@register');

        Route::get('usuario/', 'UsuarioController@index');

        Route::get('colaborador/verify', ['as' => 'funcionario.verify', 'uses' => 'FuncionarioController@verify']);
        Route::group(['prefix' => 'funcionario'], function(){

        Route::get('/', ['as' => 'funcionario.index', 'uses' => 'FuncionarioController@index']);
        Route::get('/create', ['as' => 'funcionario.add', 'uses' => 'FuncionarioController@create']);

        Route::post('/addColab', ['as' => 'funcionario.addColab', 'uses' => 'FuncionarioController@create']);
        Route::post('/add', ['as' => 'funcionario.store', 'uses' => 'FuncionarioController@store']);

        Route::get('{id}/review', ['as' => 'funcionario.review', 'uses' => 'FuncionarioController@review']);
        Route::post('{id}/review', ['as' => 'funcionario.updateReview','uses' => 'FuncionarioController@updateReview']);

        Route::get('{idFuncionario}/edit', ['as' => 'funcionario.edit', 'uses' => 'FuncionarioController@edit']);
        Route::put('{idFuncionario}/edit', ['as' => 'funcionario.update','uses' => 'FuncionarioController@update']);

        Route::get('{idFuncionario}/show', ['as' => 'funcionario.show', 'uses' => 'FuncionarioController@show']); 

        Route::get('{idFuncionario}/remove', ['as' => 'funcionario.remove', 'uses' => 'FuncionarioController@remove']);
        Route::post('{idFuncionario}/remove', ['as' => 'funcionario.destroy','uses' => 'FuncionarioController@destroy']); 
      });

      Route::group(['prefix' => 'advogado'], function(){

        Route::get('/', ['as' => 'advogado.index', 'uses' => 'AdvogadoController@index']);
        Route::get('/create', ['as' => 'advogado.add', 'uses' => 'AdvogadoController@create']);

        Route::post('/addColab', ['as' => 'advogado.addColab', 'uses' => 'AdvogadoController@create']);
        Route::post('/add', ['as' => 'advogado.store', 'uses' => 'AdvogadoController@store']);

        Route::get('{id}/review', ['as' => 'advogado.review', 'uses' => 'AdvogadoController@review']);
        Route::post('{id}/review', ['as' => 'advogado.updateReview','uses' => 'AdvogadoController@updateReview']);

        Route::get('{idAdvogado}/edit', ['as' => 'advogado.edit', 'uses' => 'AdvogadoController@edit']);
        Route::put('{idAdvogado}/edit', ['as' => 'advogado.update','uses' => 'AdvogadoController@update']);

        Route::get('{idAdvogado}/show', ['as' => 'advogado.show', 'uses' => 'AdvogadoController@show']);

        Route::get('{idAdvogado}/remove', ['as' => 'advogado.remove', 'uses' => 'AdvogadoController@remove']);
        Route::post('{idAdvogado}/remove', ['as' => 'advogado.destroy','uses' => 'AdvogadoController@destroy']);
      });

      Route::group(['prefix' => 'pessoaFisica'], function(){
        Route::get('{id}/remove', ['as' => 'fisica.remove', 'uses' => 'PessoaFisicaController@remove']);
        Route::post('{id}/remove', ['as' => 'fisica.destroy','uses' => 'PessoaFisicaController@destroy']);
      });

      Route::group(['prefix' => 'pessoaJuridica'], function(){
       Route::get('{id}/remove', ['as' => 'jurid.remove', 'uses' => 'PessoaJuridController@remove']);
       Route::post('{id}/remove', ['as' => 'jurid.destroy','uses' => 'PessoaJuridController@destroy']);
     });

      Route::group(['prefix' => 'etapa'], function(){
        Route::get('{id}/remove', ['as' => 'etapa.remove', 'uses' => 'EtapaController@remove']);
        Route::post('{id}/destroy', ['as' => 'etapa.destroy','uses' => 'EtapaController@destroy']);

      });

      Route::group(['prefix' => 'processo'], function(){
        Route::get('{id}/remove', ['as' => 'processo.remove', 'uses' => 'ProcessoController@remove']);
        Route::post('{id}/destroy', ['as' => 'processo.destroy','uses' => 'ProcessoController@destroy']);
      });

      Route::group(['prefix' => 'despesa'], function(){
        Route::get('{id}/remove', ['as' => 'despesa.remove', 'uses' => 'DespesaController@remove']);
        Route::post('{id}/destroy', ['as' => 'despesa.destroy','uses' => 'DespesaController@destroy']);
      });

    });



Route::get('/financeiro', function(){
  return view('financeiro.index');
});


/*Route::get('/adm', function(){
  return view('layouts.dashboard');
});*/

Route::get('pessoa/verify', ['as' => 'pessoa.verify', 'uses' => 'PessoaController@verify']);
Route::get('pessoa/', ['as' => 'pessoa.index', 'uses' => 'PessoaController@index']);

Route::group(['prefix' => 'pessoaFisica'], function(){
  Route::get('/pessoa', ['as' => 'fisica.add', 'uses' => 'PessoaFisicaController@create']);
  Route::post('/addPessoa', ['as' => 'fisica.addPerson', 'uses' => 'PessoaFisicaController@create']);
  Route::post('/add', ['as' => 'fisica.store', 'uses' => 'PessoaFisicaController@store']);

  Route::get('{id}/review', ['as' => 'fisica.review', 'uses' => 'PessoaFisicaController@review']);
  Route::post('{id}/review', ['as' => 'fisica.updateReview','uses' => 'PessoaFisicaController@updateReview']);

  Route::get('{id}/edit', ['as' => 'fisica.edit', 'uses' => 'PessoaFisicaController@edit']);
  Route::put('{id}/edit', ['as' => 'fisica.update','uses' => 'PessoaFisicaController@update']);

  Route::get('{id}/show', ['as' => 'fisica.show', 'uses' => 'PessoaFisicaController@show']);
  
});


Route::group(['prefix' => 'pessoaJuridica'], function(){
  Route::get('/create', ['as' => 'jurid.add', 'uses' => 'PessoaJuridController@create']);
  Route::post('/addPessoa', ['as' => 'jurid.addPerson', 'uses' => 'PessoaJuridController@create']);
  Route::post('/add', ['as' => 'jurid.store', 'uses' => 'PessoaJuridController@store']);

  Route::get('{id}/edit', ['as' => 'jurid.edit', 'uses' => 'PessoaJuridController@edit']);
  Route::put('{id}/edit', ['as' => 'jurid.update','uses' => 'PessoaJuridController@update']);

  Route::get('{id}/show', ['as' => 'jurid.show', 'uses' => 'PessoaJuridController@show']);

});

Route::group(['prefix' => 'processo'], function(){
  Route::get('/', ['as' => 'processo.index', 'uses' => 'ProcessoController@index']);

  Route::get('/verify', ['as' => 'processo.verify', 'uses' => 'ProcessoController@verify']);
  Route::get('/create', ['as' => 'processo.add', 'uses' => 'ProcessoController@create']);

  Route::post('/addProcesso', ['as' => 'processo.addProcesso', 'uses' => 'ProcessoController@create']);
  Route::post('/add', ['as' => 'processo.store', 'uses' => 'ProcessoController@store']);

  Route::get('{id}/edit', ['as' => 'processo.edit', 'uses' => 'ProcessoController@edit']);
  Route::put('{id}/edit', ['as' => 'processo.update','uses' => 'ProcessoController@update']);

  Route::get('{id}/show', ['as' => 'processo.show', 'uses' => 'ProcessoController@show']);
});

Route::group(['prefix' => 'etapa'], function(){
  Route::get('/{idProcesso}', ['as' => 'etapa.index', 'uses' => 'EtapaController@index']);

  Route::get('{idProcesso}/create', ['as' => 'etapa.create', 'uses' => 'EtapaController@create']);
  Route::post('{idProcesso}/add', ['as' => 'etapa.store', 'uses' => 'EtapaController@store']);

  Route::get('{id}/edit', ['as' => 'etapa.edit', 'uses' => 'EtapaController@edit']);
  Route::put('{id}/edit', ['as' => 'etapa.update','uses' => 'EtapaController@update']);

  Route::get('{id}/show', ['as' => 'etapa.show', 'uses' => 'EtapaController@show']);
});

Route::group(['prefix' => 'documento'], function(){
  Route::get('/{idProcesso}', ['as' => 'documento.index', 'uses' => 'DocumentoController@index']);

  Route::get('{idProcesso}/create', ['as' => 'documento.create', 'uses' => 'DocumentoController@create']);
  Route::post('{idProcesso}/add', ['as' => 'documento.store', 'uses' => 'DocumentoController@store']);

  Route::get('{id}/edit', ['as' => 'documento.edit', 'uses' => 'DocumentoController@edit']);
  Route::put('{id}/edit', ['as' => 'documento.update','uses' => 'DocumentoController@update']);
/*  Route::get('{$id}/showDoc', ['as' => 'documento.show', 'uses' => 'DocumentoController@showDoc']);
*/
});

Route::group(['prefix' => 'despesa'], function(){
  Route::get('/{idProcesso}', ['as' => 'despesa.index', 'uses' => 'DespesaController@index']);

  Route::get('{idProcesso}/create', ['as' => 'despesa.create', 'uses' => 'DespesaController@create']);
  Route::post('{idProcesso}/add', ['as' => 'despesa.store', 'uses' => 'DespesaController@store']);

  Route::get('{id}/edit', ['as' => 'despesa.edit', 'uses' => 'DespesaController@edit']);
  Route::put('{id}/edit', ['as' => 'despesa.update','uses' => 'DespesaController@update']);
});

Route::group(['prefix' => 'parcela'], function(){
  Route::get('/{idProcesso}', ['as' => 'parcela.index', 'uses' => 'ParcelaController@index']);

  Route::get('{idProcesso}/create', ['as' => 'parcela.create', 'uses' => 'ParcelaController@create']);
  Route::post('{idProcesso}/add', ['as' => 'parcela.store', 'uses' => 'ParcelaController@store']);

  Route::get('{id}/edit', ['as' => 'parcela.edit', 'uses'=>'ParcelaController@edit']);
  Route::put('{id}/edit', ['as' => 'parcela.update', 'uses'=>'ParcelaController@update']);

  Route::get('{id}/recibo', ['as' => 'parcela.recibo', 'uses'=>'ParcelaController@recibo']);
});


});
