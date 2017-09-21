 @extends('layouts.master2')
 @section('content')
 <div class="container-custom">
  @if (Session::has('message'))
  <div class="alert alert-info">{{ Session::get('message') }}</div>
  @endif
  <h1><b>Processo: {{$processo}} </b></h1>
  <h4><b>Etapa: {{$etapa->nome}}</b></h4>
  <table class="table table-striped table-bordered" style="width: 700px;">
    <tbody>
     <tr>
       <th>Nome</th>
       <td class="col-md-8">{{$nmEtapa}}</td>
     </tr>

     <tr>
       <th>Data Início</th>
       <td>{{date('d/m/Y', strtotime($etapa->dt_etapa))}}</td>
     </tr>

     <tr>
       <th>Data Final</th>
       <td>{{date('d/m/Y', strtotime($etapa->dt_prazo))}}</td>
     </tr>

    <tr>
       <th>Descrição</th>
       <td>{{$etapa->desc_etapa}}</td>
     </tr>
  </tbody>
</table>

<div class="text-center">
@if (Auth::guard('web_usuario')->user()->administrador)
<a href="{{ URL::to('/etapa/' . $etapa->id_etapa_processo . '/remove') }}" class="btn btn-lg btn-danger">Excluir <i class="fa fa-trash-o" aria-hidden="true"></i></a>&nbsp;&nbsp;
@endif
<a href="{{ URL::to('etapa/'.$etapa->id_processo)}}" class="btn btn-lg btn-info">Voltar <i class="fa fa-repeat" aria-hidden="true"></i></i></a>&nbsp;&nbsp;
<a href="{{ URL::to('/etapa/' . $etapa->id_etapa_processo . '/edit') }}" class="btn btn-lg btn-info">Editar <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
</div>
</div>
<br>
@endsection




