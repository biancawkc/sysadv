 @extends('layouts.master2')
 @section('content')

 <div class="container">
   @include('flash::message')
   <h1 class="col-lg-12 well">Parcelas de Pagamento <i class="fa fa-money parcela" aria-hidden="true"></i></h1>
   <br>
   <h2><b>Processo: <a href="{{URL::to('/processo/'.$idProcesso.'/show')}}" target="_blank">{{$processo->numero}}</a> </b><a data-toggle="collapse" data-target="#demo" class="btn btn-sm btn-info" id="open">Expandir</a><a data-toggle="collapse" data-target="#demo" class="btn btn-sm btn-warning" id="close">Esconder</a></h2>
   <div class="row">
   <div class="col-lg-9">
  <div id="demo" class="collapse">
    <p><b>Estado Processo</b>: {{$processo->desc_est_processo}} / <b>Nome Ação</b>: {{$processo->nome_acao}} / <b>Jutiça:</b> {{$processo->nm_justica}} / <b>Comarca:</b> {{$processo->comarca}} / <b>Vara:</b> {{$processo->vara}} / <b>Justiça Gratuita:</b> @if($processo->justica_grat == 1) Sim @else Não @endif / <b>Ação Gratuita:</b> @if($processo->acao_grat == 1) Sim @else Não @endif / <b>Data Início</b>: {{ date('d/m/Y', strtotime($processo->dt_inicio)) }} / <b>Data Final</b>: @if(!empty($processo->dt_final)){{ date('d/m/Y', strtotime($processo->dt_final)) }}@else - @endif </p>
  </div>
  </div>
</div>
  <br>

<!--    <a href="{{ URL::to('parcela/'.$idProcesso.'/create') }}" class="btn btn-lg btn-success"><i class="fa fa-plus" aria-hidden="true"></i></a> -->
@if($processo->id_estado_processo == 1)
<a class="btn btn-success btn-lg" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus" aria-hidden="true"></i></a> 
@else
<button class="btn btn-lg btn-success" disabled><i class="fa fa-plus" aria-hidden="true"></i></button>
@endif
   
   <br><br>
   <div class="table-responsive-force">
   <table class="table table-striped table-bordered tblCadastro text-right" >
    <thead>
      <tr>
       <th class="col-md-1">Nº</th>
       <th class="col-md-2">Valor</th>
       <th class="col-md-2">Data Vencimento</th>
       <th class="col-md-2">Data Pagamento</th>
       <!-- <th>Forma de Pagamento</th> -->
       <th class="col-md-2">Tipo</th>
       <th>Ações</th>
     </tr>
   </thead>
   <tbody>
    @if (!$parcela->isEmpty())
    @foreach($parcela as $key => $value)
    <tr>
      <td>{!! $value->num_parcela !!}</td>
      <td class="text-right">R$  {!! number_format($value->valor,2,",",".") !!}</td>
      <td>{!! date('d/m/Y', strtotime($value->dt_venc)) !!}</td>
      @if(!empty($value->dt_pag))
      <td>{!! date('d/m/Y', strtotime($value->dt_pag)) !!}</td>
      @else
      <td>-</td>
      @endif
      @if($value->id_tp_parcela == 1)
      <td>Honorários</td>
      @elseif($value->id_tp_parcela == 2)
      <td>Ganho de Causa</td>
      @endif
     
      <td class="text-center"><a href="{{ URL::to('/parcela/' . $value->id_parcela . '/edit') }}" class="btn btn-lg btn-primary" data-toggle="tooltip" data-placement="top" title="Atualizar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> &nbsp;&nbsp;
        @if( $value->dt_pag == NULL)
        <button class="btn btn-lg btn-primary" data-toggle="tooltip" data-placement="top" title="Recibo" disabled><i class="fa fa-file-o" aria-hidden="true"></i></button> 
        @else
        <a target="_blank" href="{{ URL::to('/parcela/' . $value->id_parcela . '/recibo') }}" class="btn btn-lg btn-primary" data-toggle="tooltip" data-placement="top" title="Recibo"><i class="fa fa-file-o" aria-hidden="true"></i></a>
        @endif
      </td>
    </tr>
    @endforeach
    @endif
  </tbody>
</table>
</div>
<br>
<!-- <a href="{{ URL::to('parcela/'.$idProcesso.'/create') }}" class="btn btn-lg btn-success"><i class="fa fa-plus" aria-hidden="true"></i></a>
 -->
@if($processo->id_estado_processo == 1)
<a class="btn btn-success btn-lg" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus" aria-hidden="true"></i></a> 
@else
<button class="btn btn-lg btn-success" disabled><i class="fa fa-plus" aria-hidden="true"></i></button>
@endif

<div class="modal fade" id="addModal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <!-- <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> -->
        <div class="modal-body add-modal-body">
          @include('parcela.create_modal')
        </div>
      </div>
    </div>
  </div>
</div>
<br>
@endsection

