 @extends('layouts.master2')
 @section('content')
 <div class="container-custom">
   @include('flash::message')
  <h2><b>Processo: <a href="{{URL::to('/processo/'.$processo->id_processo.'/show')}}" target="_blank">{{$processo->numero}}</a> </b><a data-toggle="collapse" data-target="#demo" class="btn btn-sm btn-info" id="open">Expandir</a><a data-toggle="collapse" data-target="#demo" class="btn btn-sm btn-warning" id="close">Esconder</a></h2>
   <div class="col-lg-9">
  <div id="demo" class="collapse">
    <p><b>Estado Processo</b>: {{$processo->desc_est_processo}} / <b>Nome Ação</b>: {{$processo->nome_acao}} / <b>Jutiça:</b> {{$processo->nm_justica}} / <b>Comarca:</b> {{$processo->comarca}} / <b>Vara:</b> {{$processo->vara}} / <b>Justiça Gratuita:</b> @if($processo->justica_grat == 1) Sim @else Não @endif / <b>Ação Gratuita:</b> @if($processo->acao_grat == 1) Sim @else Não @endif / <b>Data Início</b>: {{ date('d/m/Y', strtotime($processo->dt_inicio)) }} / <b>Data Final</b>: @if(!empty($processo->dt_final)){{ date('d/m/Y', strtotime($processo->dt_final)) }}@else - @endif </p>
  </div>
  </div>
<br>
<div class="table-responsive-force">
  <table class="table table-striped table-bordered">
    <tbody>
     <tr>
       <th class="col-md-4">Etapa</th>
       <td>{{$nmEtapa}}</td>
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
</div>
@if (Auth::guard('web_usuario')->user()->administrador)
<ul class="buttons" style="margin-left: 20%;">
<li><a href="{!! URL::previous() !!}" class="btn btn-lg btn-primary">Voltar <i class="fa fa-undo" aria-hidden="true"></i></i></a></li>
<li><a href="{{ URL::to('/etapa/' . $etapa->id_etapa_processo . '/edit') }}" class="btn btn-lg btn-info">Editar <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></li>
<li><a href="{{ URL::to('/etapa/' . $etapa->id_etapa_processo . '/remove') }}" class="btn btn-lg btn-danger">Excluir <i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
</ul>
@endif
</div>
<br>
@endsection




