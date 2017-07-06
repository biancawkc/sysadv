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
	<h1 class="col-lg-12 well "> Cadastro de Parcela Ganho de Causa <i class="fa fa-usd dollar" aria-hidden="true"></i>
	</h1>


	<div class="col-lg-12 well">
		<div class="row">
			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-4 form-group">
						<label>Valor Ação<span class="asterisk">*</span></label>
						<input type='text' name="dt_nasc" class="form-control" data-validation="required"/>
					</div>

					<div class="col-sm-2 form-group">
						<label>Nº parcelas<span class="asterisk">*</span></label>				
						<input type='text' name="dt_nasc" class="form-control" data-validation="required"/>
					</div>

					<div class="col-sm-2 form-group">
						<label>Porcentagem<span class="asterisk">*</span></label>				
						<input type='text' name="dt_nasc" class="form-control" data-validation="required"/>
					</div>

					<div class="col-sm-4 form-group">
						<label>Valor a receber<span class="asterisk">*</span></label>				
						<input type='text' name="dt_nasc" class="form-control" data-validation="required"/>
					</div>

				</div>
				<div class="row">
					<div class="col-sm-4 form-group">
						<label>Forma pagamento<span class="asterisk">*</span></label>
						<select class="form-control">
							<option>Selecione</option>
						</select>
					</div>
					<div class="col-sm-4 form-group">
						<label>Data de vencimento<span class="asterisk">*</span></label>
						<div class="input-group add-on col-md-12" >
						<div class="input-group-btn">
								<a class="btn btn-default"><i class="fa fa-calendar"></i></a>
							</div>
							<input name="name" value="" type="text" class="form-control date-picker datepicker" readonly data-date-format="dd-mm-yyyy">
							
						</div>
					</div>
					<div class="col-sm-4 form-group null">
						<label>Data de pagamento</label>
						<div class="input-group add-on col-md-12" data-date-format="yyyy-mm-dd">
						<div class="input-group-btn">
								<a class="btn btn-default"><i class="fa fa-calendar"></i></a>
							</div>
							<input name="name" value="" type="text" class="form-control date-picker datepicker" data-date-format="dd-mm-yyyy" readonly>
							
						</div>
					</div>
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