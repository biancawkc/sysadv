@extends('layouts.master2')

@section('content')
@if($errors->any())
<ul class="alert alert-danger">
	@foreach($errors->all() as $error)
	<li>{{$error}}</li>
	@endforeach
</ul>
@endif
{!! Form::open(['route'=>['documento.update', $documento->id_documento], 'method'=>'put', 'id'=>'colabForm', 'files'=>true]) !!}
@include('flash::message')
<div class="container-custom">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<h1 class="col-lg-12 well "> Editar Documento <i class="fa fa-file-text doc" aria-hidden="true"></i>
	</h1>

	<div class="col-lg-12 well">
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<label>Nome <span class="asterisk">*</span></label>					
					<input type="text" name="nome_documento" class="form-control"  data-validation="required" value="{{$documento->nome_documento}}">
				</div>

				<div class="form-group" id="file">
					<label>Arquivo <span class="asterisk">*</span></label>&nbsp;
					<a href="{{ asset('documento/'.$documento->documento) }}" target="_blank"><img src="{{ asset ('../resources/assets/images/pdf.png')}}" class="pdf"> </a>&nbsp; <a name="substituir" >Substituir</a>  
				</div>

				<div class="form-group" style="display: none;" id="arquivo">
					<label>Arquivo <span class="asterisk">*</span></label>
					<input id="input-2" name="documento" type="file" class="file" multiple data-show-upload="false" data-show-caption="true" data-validation-allowing="pdf">&nbsp; <a name="cancel" >Cancelar</a>  
				</div>
				
				<div class="form-group">
					<label>Descrição</label>
					<textarea class="form-control" rows="4" name="desc_documento"  rows="4">{{$documento->desc_documento}}</textarea>
				</div>

			</div>
		</div>
	</div>
	<div class="form-group">
		<p><b><span class="asterisk">*</span>Campos de Preenchimento Obrigatórios </b><br><br></p>
	</div>

	<div class="text-center">
		<a href="{{ URL::to('/documento/'.$documento->id_processo) }}" class="btn btn-lg btn-danger">Voltar <i class="fa fa-undo" aria-hidden="true"></i></a>
		&nbsp;&nbsp;&nbsp;
		<button type="submit" class="btn btn-lg btn-info">Salvar <i class="fa fa-check" aria-hidden="true"></i></button>
	</div>
	<br>
	<br>
</div> 

{!! Form::close() !!}
@endsection

@section('content_js')
<script type="text/javascript" >

	$.validate({
		lang: 'pt',
		modules : 'brazil'
	});


$(document).ready(function() {
   $('a[name="substituir"]').click(function () {
      $('#arquivo').show();
      $('#file').hide();
    });
    $('a[name="cancel"]').click(function () {
      $('#arquivo').hide();
      $('#file').show();
    });
});

</script>

@endsection