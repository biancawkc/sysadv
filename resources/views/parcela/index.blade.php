 @extends('layouts.master2')
 @section('content')
 <div class="container">
   @include('flash::message')
   <h1 class="col-lg-12 well">Parcelas de Pagamento <i class="fa fa-money" aria-hidden="true"></i></h1>
   <br>
   <h2><b>Processo: <a href="{{URL::to('/processo/'.$idProcesso.'/show')}}">{{$processo->numero}}</a> </b></h2>
   <br>
<!--    <a href="{{ URL::to('parcela/'.$idProcesso.'/create') }}" class="btn btn-lg btn-success"><i class="fa fa-plus" aria-hidden="true"></i></a> -->
   <a class="btn btn-success btn-lg" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus" aria-hidden="true"></i></a> 
   <br><br>
   <table class="table table-striped table-bordered tblCadastro" >
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
      <td>R$ {!! $value->valor !!}</td>
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
<br>
<!-- <a href="{{ URL::to('parcela/'.$idProcesso.'/create') }}" class="btn btn-lg btn-success"><i class="fa fa-plus" aria-hidden="true"></i></a>
 -->
 <a class="btn btn-success btn-lg" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus" aria-hidden="true"></i></a> 

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

@section('content_js')

@endsection


