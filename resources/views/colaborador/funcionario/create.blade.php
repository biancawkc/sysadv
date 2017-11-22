@extends('layouts.master2')

@section('content')
{!! Form::open(['route'=>'funcionario.store', 'class'=>'form', 'autocomplete'=> 'off' ]) !!}

<div class="container-custom">
	@if($errors->any())
<ul class="alert alert-danger">
	@foreach($errors->all() as $error)
	<li>{{$error}}</li>
	@endforeach
</ul>
@endif
@include('flash::message')
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<h1 class="col-lg-12 well "> Cadastro de Funcionário <i class="fa fa-user-plus user-plus" aria-hidden="true"></i>
	</h1>

	<div class="col-lg-12 well">
		<div class="row">
			<div class="col-sm-12">

				<div class="form-group">
					<label>Nome Completo<span class="asterisk">*</span></label>
					<input type="text" placeholder="" name="nome" class="form-control" data-validation="required custom"  data-validation-regexp="^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$" autofocus value="{{ old('nome') }}">
				</div>	

				<div class="row">

					<div class="col-sm-4 form-group">
						<label>Data Nasc.<span class="asterisk">*</span></label>
						<div class="input-group add-on col-md-12" >
							<div class="input-group-btn">
								<a class="btn btn-default"><i class="fa fa-calendar"></i></a>
							</div>
							<input name="dt_nasc" type="text" class="form-control datepicker date" data-validation="birthdate" data-validation-format="dd/mm/yyyy" placeholder="dd/mm/aaaa" value="{{ old('dt_nasc') }}">
						</div>
					</div>

					<div class="col-sm-4 form-group">
						<label>Estado Civil<span class="asterisk">*</span></label>
						<select class="form-control" name="id_estado_civil" data-validation="required">
							<option value="">Selecione</option>
							@foreach($civil as $civ)
							<option value="{{$civ->id_estado_civil}}">{{$civ->desc_estado_civil}}</option>
							@endforeach
						</select>
					</div>

					@if ($errors->any())
					<div class="col-sm-4 form-group">
						<label>CPF<span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="cpf" class="form-control cpf" value="{{ old('cpf') }}"readonly data-validation="required" id="cpf">
					</div>
					@else
					<div class="col-sm-4 form-group">
						<label>CPF<span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="cpf" class="form-control cpf" value="{{ $cpf }}" readonly data-validation="required" id="cpf">
					</div>
					@endif

				</div>

				<div class="row">

					<div class="col-sm-4 form-group">
						<label>RG<span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="rg" class="form-control rg" value="{{ old('rg') }}" data-validation="required" id="rg">
					</div>


					<div class="col-sm-2 form-group">
						<label>Órg. Emiss.<span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="orgao_exp" class="form-control" data-validation="required" value="{{ old('orgao_exp') }}" >
					</div>	

				</div>

				<div class="row">
					<div class="col-sm-4 form-group null">
						<label>CTPS - Número</label>
						<input type="text" name="ctps" class="form-control" value="{{ old('ctps') }}" placeholder="Número">
					</div>	
					<div class="col-sm-3 form-group null">
						<label>CTPS - Série</label>
						<input type="text" name="serie_ctps" class="form-control ctps_serie" value="{{ old('serie_ctps') }}" placeholder="Série">
					</div>	

					<div class="col-sm-4 form-group">
						<label>Data de Admissão<span class="asterisk">*</span></label>
						<div class="input-group add-on col-md-12" >
							<div class="input-group-btn">
								<a class="btn btn-default"><i class="fa fa-calendar"></i></a>
							</div>
							<input name="dt_admissao" type="text" class="form-control dtAdmissao date" data-date-format="dd/mm/yyyy" data-validation="date" data-validation-format="dd/mm/yyyy" placeholder="dd/mm/aaaa" value="{{ old('dt_admissao') }}">
						</div>
					</div>	

				</div>
				
				<div class="form-group">
					<label>Qualificaçōes</label>
					<textarea class="form-control" rows="4" name="qualificacoes"  rows="4" >{{ old('qualificacoes') }}</textarea>
				</div>

			</div>
		</div>
	</div>
	<div class="form-group">
		<p><b><span class="asterisk">*</span>Campos de Preenchimento Obrigatórios </b><br><br></p>
	</div>

	<div class="text-center">
		<a href="{{ URL::to('/colaborador/verify') }}" class="btn btn-lg btn-danger">Voltar <i class="fa fa-undo" aria-hidden="true"></i></a>
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
<script type="text/javascript">
	$.validate({
  modules : 'date'
});
</script>
@endsection