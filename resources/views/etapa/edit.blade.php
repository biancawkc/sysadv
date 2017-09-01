@extends('layouts.master2')

@section('content')
@if($errors->any())
<ul class="alert alert-danger">
	@foreach($errors->all() as $error)
	<li>{{$error}}</li>
	@endforeach
</ul>
@endif
{!! Form::open(['route'=>['etapa.update', $etapa->id_etapa_processo], 'method'=>'put', 'id'=>'colabForm']) !!}
@include('flash::message')
<div class="container-custom">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<h1 class="col-lg-12 well "> Editar Etapa <i class="fa fa-calendar etapa" aria-hidden="true"></i>
	</h1>

	<div class="col-lg-12 well">
		<div class="row">
			<div class="col-sm-12">

				<div class="form-group">
					<label>Nome<span class="asterisk">*</span></label>
					<input type="text" placeholder="" name="nome" class="form-control" data-validation="required" value="{{$etapa->nome}}">
				</div>	

				<div class="form-group">
							<label>Instância<span class="asterisk">*</span></label>					
							<input type='text' name="instancia" class="form-control" data-validation="required" value="{{$etapa->instancia}}" />
					</div>

				<div class="row">
					<div class="col-sm-4 form-group">
						<label>Data início<span class="asterisk">*</span></label>
						<div class="input-group add-on col-md-12" >
						<div class="input-group-btn">
								<a class="btn btn-default"><i class="fa fa-calendar"></i></a>
							</div>
							<input name="dt_etapa" type="text" class="form-control date-picker datepicker date" data-date-format="dd/mm/yyyy" data-validation="date" data-validation-format="dd/mm/yyyy" placeholder="dd/mm/aaaa" value="{{date('d/m/Y', strtotime($etapa->dt_etapa))}}">
							
						</div>
					</div>

					<div class="col-sm-4 form-group">
						<label>Data final<span class="asterisk">*</span></label>
						<div class="input-group add-on col-md-12" >
						<div class="input-group-btn">
								<a class="btn btn-default"><i class="fa fa-calendar"></i></a>
							</div>
							<input name="dt_prazo" type="text" class="form-control date-picker datepicker date" data-date-format="dd/mm/yyyy" data-validation="date" data-validation-format="dd/mm/yyyy" placeholder="dd/mm/aaaa" value="{{date('d/m/Y', strtotime($etapa->dt_prazo))}}">
							
						</div>
					</div>

				</div>
				
				<div class="form-group">
					<label>Descrição<span class="asterisk">*</span></label>
					<textarea class="form-control" rows="4" name="desc_etapa" data-validation="required">{{$etapa->desc_etapa}}</textarea>
				</div>

			</div>
		</div>
	</div>
	<div class="form-group">
		<p><b><span class="asterisk">*</span>Campos de Preenchimento Obrigatórios </b><br><br></p>
	</div>

	<div class="text-center">
		<a href="{{ URL::to('/etapa/'.$etapa->id_processo) }}" class="btn btn-lg btn-danger">Voltar <i class="fa fa-undo" aria-hidden="true"></i></a>
		&nbsp;&nbsp;&nbsp;
		<button type="submit" class="btn btn-lg btn-info">Salvar <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
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

	$("#colabForm").submit(function() {
		$("#cpf").unmask();
		$("#rg").unmask();
	});



</script>

@endsection