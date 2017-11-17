 @extends('layouts.master2')
 @section('content')
 <div class="container-custom">
   @include('flash::message')
   <table class="table table-striped table-bordered" style="width: 700px;">
    <tbody>
     <tr>
       <th class="col-md-3">Nome Completo</th>
       <td colspan="3">{{$pessoaFisica->nome}}</td>
     </tr>

     <tr>
       <th>RG</th>
       <td class="rg">{{$pessoaFisica->rg}}</td>
       <th class="col-md-3"> Órg. Emiss.</th>
       <td>{{$pessoaFisica->orgao_exp}}</td>
     </tr>

     <tr>
       <th>CPF</th>
       <td class="cpf">{{$pessoaFisica->cpf}}</td>
       <th>Estado Civil</th>
       <td>{{$civil->desc_estado_civil}}</td>
     </tr>

     <tr>
       <th>Data de Nascimento</th>
       <td colspan="3">{{ date('d/m/Y', strtotime($pessoaFisica->dt_nasc))}}</td>
     </tr>
  </tbody>

</table>

<table class="table table-striped table-bordered" style="width: 700px;">
  <tr>
    <th class="col-md-3">Email</th>
    <td>{{$parte->email}}</td>
  </tr>

   @foreach($telefone as $tel)
   <tr>
    <th>Telefone {{$tel->tp_telefone}}</th>
    <td class="phone_with_ddd">{{$tel->telefone}}</td>
    </tr>
    @endforeach
</table>

<table class="table table-striped table-bordered" style="width: 700px;">
  <tr>
    <th style="width: 18%">CEP</th>
    <td>{{$endereco->cep}}</td>
    <th>Bairro</th>
    <td>{{$endereco->bairro}}</td>
  </tr>

  <tr>
    <th>Cidade</th>
    <td>{{$endereco->cidade}}</td>
    <th style="width: 18%">UF</th>
    <td>{{$endereco->uf}}</td>
  </tr>

  <tr>
    <th >Logradouro</th>
    <td>{{$endereco->logradouro}}</td>
    <th>Número</th>
    <td>{{$endereco->numero}}</td>
  </tr>
  <tr>
    <th colspan="1">Complemento</th>
    <td colspan="3">{{$endereco->complemento}}</td>
  </tr>
</table>

<table class="table table-striped table-bordered" style="width: 700px;">
  <tr>
    <th class="col-md-3">CBO</th>
    @if(!is_null($pessoaFisica->id_profissao))
    <td>{{$profissao->cbo}}</td>
    @else
    <td> </td>
    @endif
  </tr>
  <tr>
    <th>Profissão</th>
    @if(!is_null($pessoaFisica->id_profissao))
    <td>{{$profissao->nm_profissao}}</td>
     @else
     <td> </td>
    @endif
  </tr>
  <tr>
    <th>Remuneracao</th>
    <td>{{$pessoaFisica->remuneracao}}</td>
  </tr>
</table>
<div class="text-center">
@if (Auth::guard('web_usuario')->user()->administrador)
  <a href="{{ URL::to('/pessoaFisica/' . $pessoaFisica->id_parte . '/remove') }}" class="btn btn-lg btn-danger">Deletar <i class="fa fa-trash" aria-hidden="true"></i></a>&nbsp;&nbsp;
  @endif
  <a href="{{ URL::to('/pessoaFisica/' . $pessoaFisica->id_parte. '/edit') }}" class="btn btn-lg btn-info">Editar <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;
</div>
</div>
</div>
<br>
@endsection




