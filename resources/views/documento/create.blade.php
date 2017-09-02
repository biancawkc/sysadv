@extends('layouts.master2')

@section('content')
@if($errors->any())
<ul class="alert alert-danger">
	@foreach($errors->all() as $error)
	<li>{{$error}}</li>
	@endforeach
</ul>
@endif
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
					<input id="input-2" name="documento" type="file" class="file" multiple data-show-upload="false" data-show-caption="true" data-validation-allowing="pdf, png, jpeg" data-validation="required">
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
		<a href="{{ URL::to('/documento/'.$idProcesso) }}" class="btn btn-lg btn-danger">Voltar <i class="fa fa-undo" aria-hidden="true"></i></a>
		&nbsp;&nbsp;&nbsp;
		<button type="submit" class="btn btn-lg btn-info">Cadastrar <i class="fa fa-plus" aria-hidden="true"></i></button>
	</div>
	<br>
	<br>
</div> 

{!! Form::close() !!}
@endsection

@section('content_js')


@endsection