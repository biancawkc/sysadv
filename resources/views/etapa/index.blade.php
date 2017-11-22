 @extends('layouts.master2')
 @section('content')
 <div class="container">
   @include('flash::message')
   <h1 class="col-lg-12 well" >Etapas Cadastradas <i class="fa fa-calendar-check-o etapa" aria-hidden="true"></i></h1>
   <!-- <a href="{{ URL::to('colaborador/verify') }}" class="btn btn-md btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Cadastrar</a> -->
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
   <!-- <a href="{{ URL::to('/etapa/' . $idProcesso. '/create') }}" class="btn btn-lg btn-success"> <i class="fa fa-calendar-plus-o fa-1x" aria-hidden="true"></i></a>  -->
   @if($processo->id_estado_processo == 1)
   <a  class="btn btn-success btn-lg" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus" aria-hidden="true"></i></a> 
   @else
    <button class="btn btn-lg btn-success" disabled><i class="fa fa-plus" aria-hidden="true"></i></button>
   @endif
   <br>
   <br>
   <div class="table-responsive-force">
   <table class="table table-striped table-bordered tblCadastro " >
    <thead>
        <tr>
           <!-- <th>ID</th> -->
           <th class="col-md-6">Nome</th>
           <th class="col-md-2">Data Início</th>
           <th class="col-md-2">Data Final</th>
           <th>Ação</th>
       </tr>
   </thead>
   <tbody>
    @if (!$etapas->isEmpty())
    @foreach($etapas as $key => $value)
    <tr>
        <!-- <td>{!! $value->id_etapa_processo !!}</td> -->
        <td>{!! $value->nm_etapa !!}</td>
        <td>{!! date('d/m/Y', strtotime($value->dt_etapa)) !!}</td>
        <td>{!! date('d/m/Y', strtotime($value->dt_prazo)) !!}</td>
        <td>
            <a href="{{ URL::to('/etapa/' . $value->id_etapa_processo . '/show') }}" class="btn btn-lg btn-primary" data-toggle="tooltip" data-placement="top" title="Detalhes"> <i class="fa fa-info-circle" aria-hidden="true"></i></a>    
        </td>
    </tr>
    @endforeach
    @endif
</tbody>
</table>
</div>
<br>
<!-- <a href="{{ URL::to('/etapa/' . $idProcesso. '/create') }}" class="btn btn-lg btn-success"> <i class="fa fa-calendar-plus-o fa-1x" aria-hidden="true"></i></a>
 -->
 @if($processo->id_estado_processo == 1)
   <a  class="btn btn-success btn-lg" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus" aria-hidden="true"></i></a> 
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
          {!! Form::open(['route'=>['etapa.store', $idProcesso], 'method'=>'post', 'id'=>'colabForm']) !!}
@include('flash::message')
<div class="container-custom">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <h1 class="col-lg-12 well "> Cadastro de Etapa <i class="fa fa-calendar-plus-o fa-1x etapa" aria-hidden="true"></i>
  </h1>

  <div class="col-lg-12 well">
    <div class="row">
      <div class="col-sm-12">
        <div class="row">
          <div class="col-sm-4 form-group">
            <label>Data início<span class="asterisk">*</span></label>
            <div class="input-group add-on col-md-12" >
              <div class="input-group-btn">
                <a class="btn btn-default"><i class="fa fa-calendar"></i></a>
              </div>
              <input name="dt_etapa" type="text" class="form-control date etapaIni" data-validation="date" data-validation-format="dd/mm/yyyy" placeholder="dd/mm/aaaa" readonly>
            </div>
          </div>
          <div class="col-sm-4 form-group">
            <label>Data final<span class="asterisk">*</span></label>
            <div class="input-group add-on col-md-12" >
              <div class="input-group-btn">
                <a class="btn btn-default"><i class="fa fa-calendar"></i></a>
              </div>
              <input name="dt_prazo" type="text" class="form-control date etapaFn" data-validation="date" data-validation-format="dd/mm/yyyy" placeholder="dd/mm/aaaa" readonly>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Nome<span class="asterisk">*</span></label>
          <select class="form-control single-select" name="id_etapa" data-validation="required" style="width: 100%;">
            <option value="">Selecione</option>
            @if($strEtapa[1] == "estadual")
            @foreach($nmEtapasE as $nmEtapaE)
            <option value="{{$nmEtapaE->id_etapa}}">{{$nmEtapaE->nm_etapa}}</option>
            @endforeach 
            @elseif ($strEtapa[1] == "federal")
            @foreach($nmEtapasF as $nmEtapaF)
            <option value="{{$nmEtapaF->id_etapa}}">{{$nmEtapaF->nm_etapa}}</option>
            @endforeach 
            @elseif($strEtapa[1] !== "federal" && $strEtapa[1] !== "estadual")
            @foreach($nmEtapas as $nmEtapa)
            <option value="{{$nmEtapa->id_etapa}}">{{$nmEtapa->nm_etapa}}</option>
            @endforeach    
            @endif       
          </select>
        </div>  

        <div class="form-group">
          <label>Descrição<span class="asterisk">*</span></label>
          <textarea class="form-control" rows="4" name="desc_etapa" data-validation="required"></textarea>
        </div>

      </div>
    </div>
  </div>
  <div class="form-group">
    <p><b><span class="asterisk">*</span>Campos de Preenchimento Obrigatórios </b><br><br></p>
  </div>

  <div class="text-center">
    <a data-dismiss="modal" class="btn btn-lg btn-danger">Voltar <i class="fa fa-undo" aria-hidden="true"></i></a>
    &nbsp;&nbsp;&nbsp;
    <button type="submit" class="btn btn-lg btn-info">Cadastrar <i class="fa fa-plus" aria-hidden="true"></i></button>
  </div>
  <br>
  <br>
</div> 

{!! Form::close() !!}
        </div>
       <!--  <div class="modal-footer">
          <a href="{{ URL::to('/cadastrar_usuario') }}" class="btn btn-info">Voltar</a>
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div> -->
      </div>
    </div>
  </div>
</div>
<br>
@endsection

@section('content_js')

@endsection


