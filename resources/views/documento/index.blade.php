 @extends('layouts.master2')
 @section('content')
 <div class="container">
   @include('flash::message')
   <h1 class="col-lg-12 well" >Documentos Cadastrados <i class="fa fa-file-text doc" aria-hidden="true"></i></h1>
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
   <!-- <a href="{{ URL::to('/documento/' . $idProcesso. '/create') }}" class="btn btn-lg btn-success"> <i class="fa fa-plus-square" aria-hidden="true"></i></a>  -->
   @if($processo->id_estado_processo == 1)
   <a class="btn btn-success btn-lg" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus" aria-hidden="true"></i></a> 
   @else
    <button class="btn btn-lg btn-success" disabled><i class="fa fa-plus" aria-hidden="true"></i></button>
   @endif
   
   <br>
   <br>
   <table class="table table-striped table-bordered tblCadastro" >
    <thead>
      <tr>
        <!--  <th>ID</th> -->
        <th>Nome</th>
        <th>Documento</th>
        <th>Ação</th>
      </tr>
    </thead>
    <tbody>
      @if (!$documentos->isEmpty())
      @foreach($documentos as $key => $value)
      <tr>
        <!-- <td>{!! $value->id_documento !!}</td>
      -->  <td>{!! $value->nome_documento !!}</td>
      <td class="text-center">
        <?php $p =explode('.', $value->documento); ?>
        @if( array_pop($p) == 'pdf'  )
        <a href="{{ asset('documento/'.$value->documento) }}" target="_blank"><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></a>
        @else
        <a href="{{ asset('documento/'.$value->documento) }}" target="_blank"><i class="fa fa-picture-o fa-2x" aria-hidden="true"></i></a>
        @endif
      </td>
      <td class="text-center">
         <a href="{{ URL::to('/documento/' . $value->id_documento . '/edit') }}" class="btn btn-lg btn-primary" data-toggle="tooltip" data-placement="top" title="Detalhes"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> &nbsp;&nbsp;
         <a href="{{ URL::to('/documento/' . $value->id_documento . '/remove') }}" class="btn btn-lg btn-danger" data-toggle="tooltip" data-placement="top" title="Deletar"> <i class="fa fa-trash" aria-hidden="true"></i></a> 
      </td>
    </tr>
    @endforeach
    @else
    <td colspan="3">
      Não há registros
    </td>
    @endif
  </tbody>
</table>
<br>
<!-- <a href="{{ URL::to('/documento/' . $idProcesso. '/create') }}" class="btn btn-lg btn-success"> <i class="fa fa-plus-square" aria-hidden="true"></i></a> --> 

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
          {!! Form::open(['route'=>['documento.store', $idProcesso], 'method'=>'post', 'id'=>'colabForm', 'files'=>true]) !!}
          @include('flash::message')
          <div class="container-custom">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <h1 class="col-lg-12 well "> Cadastro de Documento <i class="fa fa-file-text doc" aria-hidden="true"></i>
            </h1>

            <div class="col-lg-12 well">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Nome <span class="asterisk">*</span></label>         
                    <input type="text" placeholder="" name="nome_documento" class="form-control"  data-validation="required">
                  </div>

                  <div class="form-group">

                    <label>Arquivo (PDF, JPEG, PNG) <span class="asterisk">*</span></label>         
                    <input id="input-2" name="documento" type="file" class="file" multiple data-show-upload="false" data-show-caption="true" data-validation-allowing="pdf, png, jpeg">
                  </div>
                  
                  <div class="form-group">
                    <label>Descrição</label>
                    <textarea class="form-control" rows="4" name="desc_documento"  rows="4"></textarea>
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
      </div>
    </div>
  </div>

</div>
<br>
@endsection

@section('content_js')
<script type="text/javascript">
  $.validate({
  modules : 'file'
});
</script>
@endsection


