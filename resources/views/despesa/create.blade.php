@extends('layouts.master2')

@section('content')
@if($errors->any())
<ul class="alert alert-danger">
	@foreach($errors->all() as $error)
	<li>{{$error}}</li>
	@endforeach
</ul>
@endif
{!! Form::open(['route'=>'funcionario.store', 'id'=>'colabForm' ]) !!}
@include('flash::message')
<div class="container-custom">
	<input type="hidden" name="ativo" value="0">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<h1 class="col-lg-12 well "> Cadastro de Despesa <i class="fa fa-money" aria-hidden="true"></i>
	</h1>

	<div class="col-lg-12 well">
		<div class="row">
			<div class="col-sm-12">

				<div class="row">

					<div class="col-sm-4 form-group">
						<div class="input-group">
							<label>Data <span class="asterisk">*</span></label>					
							<input type='text' name="dt_despesa" class="form-control" data-validation="required"/>
						</div>
					</div>

					<div class="col-sm-4 form-group">
						<label>Valor<span class="asterisk">*</span></label>
						<input type='text' name="valor" class="form-control" />
					</div>

				</div>
				
				<div class="form-group">
					<label>Descrição<span class="asterisk">*</span></label>
					<textarea class="form-control" rows="4" name="desc_etapa"  rows="4" data-validation="required"></textarea>
				</div>

			</div>
		</div>
	</div>
	<div class="form-group">
		<p><b><span class="asterisk">*</span>Campos de Preenchimento Obrigatórios </b><br><br></p>
	</div>

	<div class="text-center">
		<a href="{{ URL::to('/verify') }}" class="btn btn-lg btn-danger">Voltar <i class="fa fa-undo" aria-hidden="true"></i></a>
		&nbsp;&nbsp;&nbsp;
		<button type="submit" class="btn btn-lg btn-info">Cadastrar <i class="fa fa-plus" aria-hidden="true"></i></button>
	</div>
	<br>
	<br>
</div> 

</form> 
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


	$(function () {
		$('#datetimepicker1').datetimepicker();
	});

</script>

@endsection