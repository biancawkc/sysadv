 @extends('layouts.master2')
 @section('content')
 <div class="container">
   @include('flash::message')
   <h1 class="col-lg-12 well" >Etapas Cadastradas <i class="fa fa-calendar-check-o etapa" aria-hidden="true"></i></h1>
   <!-- <a href="{{ URL::to('colaborador/verify') }}" class="btn btn-md btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Cadastrar</a> -->
   <br>
   <!-- <a href="{{ URL::to('/etapa/' . $idProcesso. '/create') }}" class="btn btn-lg btn-success"> <i class="fa fa-calendar-plus-o fa-1x" aria-hidden="true"></i></a>  -->
   <a  class="btn btn-success btn-lg" data-toggle="modal" data-target="#addModal"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i></a> 
   <br>
   <br>
   <table class="table table-striped table-bordered text-center tblCadastro " >
    <thead>
        <tr>
           <!-- <th>ID</th> -->
           <th>Nome</th>
           <th>Data Início</th>
           <th>Data Final</th>
           <th>Ações</th>
       </tr>
   </thead>
   <tbody>
    @if (!$etapas->isEmpty())
    @foreach($etapas as $key => $value)
    <tr>
        <!-- <td>{!! $value->id_etapa_processo !!}</td> -->
        <td>{!! $value->nome !!}</td>
        <td>{!! date('d/m/Y', strtotime($value->dt_etapa)) !!}</td>
        <td>{!! date('d/m/Y', strtotime($value->dt_prazo)) !!}</td>
        <td>
            <a href="{{ URL::to('/etapa/' . $value->id_etapa_processo . '/show') }}" class="btn btn-lg btn-info"> <i class="fa fa-info-circle" aria-hidden="true"></i></a>    
        </td>
    </tr>
    @endforeach
    @endif
</tbody>
</table>
<br>
<!-- <a href="{{ URL::to('/etapa/' . $idProcesso. '/create') }}" class="btn btn-lg btn-success"> <i class="fa fa-calendar-plus-o fa-1x" aria-hidden="true"></i></a>
 -->
 <a class="btn btn-success btn-lg" data-toggle="modal" data-target="#addModal"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i></a> 

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

        <div class="form-group">
          <label>Nome<span class="asterisk">*</span></label>
          <input type="text" placeholder="" name="nome" class="form-control" data-validation="required">
        </div>  

        <div class="form-group">
          <label>Instância<span class="asterisk">*</span></label>         
          <input type='text' name="instancia" class="form-control" data-validation="required"/>
        </div>

        <div class="row">
          <div class="col-sm-4 form-group">
            <label>Data início<span class="asterisk">*</span></label>
            <div class="input-group add-on col-md-12" >
              <div class="input-group-btn">
                <a class="btn btn-default"><i class="fa fa-calendar"></i></a>
              </div>
              <input name="dt_etapa" type="text" class="form-control date-picker datepicker date" data-date-format="dd/mm/yyyy" data-validation="date" data-validation-format="dd/mm/yyyy" placeholder="dd/mm/aaaa">
            </div>
          </div>
          <div class="col-sm-4 form-group">
            <label>Data final<span class="asterisk">*</span></label>
            <div class="input-group add-on col-md-12" >
              <div class="input-group-btn">
                <a class="btn btn-default"><i class="fa fa-calendar"></i></a>
              </div>
              <input name="dt_prazo" type="text" class="form-control date-picker datepicker date" data-date-format="dd/mm/yyyy" data-validation="date" data-validation-format="dd/mm/yyyy" placeholder="dd/mm/aaaa">
            </div>
          </div>
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
    <a href="{{ URL::to('/etapa/'.$idProcesso) }}" class="btn btn-lg btn-danger">Voltar <i class="fa fa-undo" aria-hidden="true"></i></a>
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
<script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
@endsection


