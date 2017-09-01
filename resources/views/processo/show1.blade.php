 @extends('layouts.master2')
 @section('content')
 <div class="container-custom">
 @include('flash::message')
  <h1><b>Processo: {{$processo->numero}} </b></h1>
  <h4><b>Estado</b>: {{$estadoProcesso->desc_est_processo}}</h4>
  <table class="table table-striped table-bordered" style="width: 700px;">
    <tbody>
     <tr>
       <th class="col-md-3">Nome da ação</th>
       <td colspan="4">{{$processo->nome_acao}}</td>
     </tr>

     <tr>
       <th>Justiça gratuita</th>
       @if($processo->justica_grat == "1")
       <td>Sim</td>
       @else
       <td>Não</td>
       @endif
        <th class="col-md-3">Ação gratuita </th>
       @if($processo->acao_grat == "1")
       <td>Sim</td>
       @else
       <td>Não</td>
       @endif
     </tr>

     <tr>
       <th>Data de início</th>
       <td>{{$processo->dt_inicio}}</td>
        <th>Data final</th>
       <td>{{$processo->dt_final}}</td>
     </tr>

     <tr>
       <th>Justiça</th>
       <td colspan="4">{{$justica->nm_justica}}</td>
     </tr>

     <tr>
       <th>Comarca</th>
       <td colspan="4">{{$comarca->comarca}}</td>
     </tr>

     <tr>
       <th>Vara</th>
       <td colspan="4">{{$processo->id_vara}}</td>
     </tr>

     <tr>
      <th>Descrição</th>
      <td colspan="4">{{$processo->desc_processo}}</td>
    </tr>

  </tbody>

</table>

<h3>Cliente(s)</h3>
@if (!$pessoaJuridicaC->isEmpty())
@foreach($pessoaJuridicaC as $value)
<table class="table table-striped table-bordered" style="width: 700px;">
  <tbody>
   <tr>
     <th>Razão social</th>
     <td>{{$value->razao_social}}</td>
   </tr>
   <tr>
     <th>Nome fantasia</th>
     <td>{{$value->nm_fantasia}}</td>
   </tr>
   <tr>
    <th>CNPJ</th>
    <td>{{$value->cnpj}}</td>
  </tr>
  <tr>
   <th>Inscrição estadual</th>
   <td>{{$value->ins_estadual}}</td>
 </tr>
</tbody>
</table>
@endforeach
@endif

@if(!$pessoaFisicaC->isEmpty())
@foreach($pessoaFisicaC as $values)
<table class="table table-striped table-bordered" style="width: 700px;">
  <tbody>
    <tr>
      <th class="col-md-3">Nome</th>
      <td colspan="4">{{$values -> nome}}</td>
    </tr>

    <tr>
    <th>RG</th>
      <td>{{$values -> rg}}</td>
      <th class="col-md-3">Orgão Exp.</th>
      <td>{{$values -> orgao_exp}}</td>
    </tr>
    <tr>
      <th>CPF</th>
      <td>{{$values -> cpf}}</td>
      <th>Estado civil</th>
      <td>{{$values -> desc_estado_civil}}</td>
    </tr>
    <tr>
      <th>Data de nascimento</th>
      <td colspan="4">{{$values -> dt_nasc}}</td>
    </tr>
    <tr>
      <th>CTPS</th>
      <td colspan="4">{{$values -> ctps}}</td>
    </tr>
    <tr>
      <th>CBO</th>
      <td>{{$values->cbo}}</td>
       <th>Remuneração</th>
      <td>{{$values->remuneracao}}</td>
    </tr>
    <tr>
      <th>Profissão</th>
      <td colspan="4">{{$values->nm_profissao}}</td>
    </tr>
  </tbody>
</table>
@endforeach
@endif
<h3>Parte(s) Adversa(s)</h3>
@if (!$pessoaJuridicaA->isEmpty())
    @foreach($pessoaJuridicaA as $value)
<table class="table table-striped table-bordered" style="width: 700px;">
  <tbody>
    <tr>
     <th>Razão social</th>
     <td colspan="4">{{$value->razao_social}}</td>
   </tr>
   <tr>
     <th>Nome fantasia</th>
     <td colspan="4">{{$value->nm_fantasia}}</td>
   </tr>
   <tr>
    <th>CNPJ</th>
    <td>{{$value->cnpj}}</td>
    <th>Inscrição estadual</th>
   <td>{{$value->ins_estadual}}</td>
  </tr>
 </tbody>
 </table>
 @endforeach
 @endif

 @if(!$pessoaFisicaA->isEmpty())
 @foreach($pessoaFisicaA as $values)
 <table class="table table-striped table-bordered" style="width: 700px;">
  <tbody>
 <tr>
  <th>Nome</th>
  <td class="col-md-8">{{$values -> nome}}</td>
</tr>
<tr>
  <th>RG</th>
  <td>{{$values -> rg}}</td>
</tr>
<tr>
  <th>Orgão Exp.</th>
  <td>{{$values -> orgao_exp}}</td>
</tr>
<tr>
  <th>CPF</th>
  <td>{{$values -> cpf}}</td>
</tr>
<tr>
  <th>Data de nascimento</th>
  <td>{{$values -> dt_nasc}}</td>
</tr>
<tr>
  <th>Estado civil</th>
  <td>{{$values -> desc_estado_civil}}</td>
</tr>
<tr>
  <th>CTPS</th>
  <td>{{$values -> ctps}}</td>
</tr>
<tr>
  <th>CBO</th>
  <td>{{$values->cbo}}</td>
</tr>
<tr>
  <th>Profissão</th>
  <td>{{$values->nm_profissao}}</td>
</tr>
<tr>
  <th>Remuneração</th>
  <td>{{$values->remuneracao}}</td>
</tr>
</tbody>
</table>
@endforeach
@endif
<p>Data de criação: {{date('d/m/Y H:i:s', strtotime($processo->dt_criacao))}} &nbsp;&nbsp;&nbsp; Última alteração feita em {{date('d/m/Y H:i:s', strtotime($processo->dt_criacao))}} por {{$usuario->username}}  </p>
<br>
<div class="text-center">
  <a href="{{ URL::to('/processo/' . $processo->id_processo . '/remove') }}" class="btn btn-lg btn-danger">Deletar <i class="fa fa-trash" aria-hidden="true"></i></a>&nbsp;&nbsp;
  <a href="{{ URL::to('/processo/' . $processo->id_processo. '/edit') }}" class="btn btn-lg btn-info">Editar <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;
  <a href="{{ URL::to('/etapa/' . $processo->id_processo) }}" class="btn btn-lg btn-success">Etapas <i class="fa fa-calendar" aria-hidden="true"></i></a>&nbsp;&nbsp;
  <a href="" class="btn btn-lg btn-warning">Docs <i class="fa fa-file-text" aria-hidden="true"></i></a>&nbsp;&nbsp;
  <a href="" class="btn btn-lg btn-warning">Relatório <i class="fa fa-files-o" aria-hidden="true"></i></a>
</div>
</div>
<br>
@endsection




