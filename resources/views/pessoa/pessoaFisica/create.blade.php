@extends('layouts.master2')
@section('content')
@if($errors->any())
<ul class="alert alert-danger">
	@foreach($errors->all() as $error)
	<li>{{$error}}</li>
	@endforeach
</ul>
@endif
{!! Form::open(['route'=>'fisica.store', 'class'=>'form' ]) !!}
@include('flash::message')
<div class="container-custom">
	<input type="hidden" name="ativo" value="1">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<h1 class="col-lg-12 well "> Cadastro de Pessoa Física <i class="fa fa-user-plus user-plus" aria-hidden="true"></i>
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
						<label>Data Nasc.<span class="asterisk">*</span></label><div class="input-group add-on col-md-12" >
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
						<input type="text" placeholder="" name="rg" class="form-control rg" value="" data-validation="required" id="rg" value="{{ old('rg') }}">
					</div>


					<div class="col-sm-2 form-group">
						<label>Órg. Emiss.<span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="orgao_exp" class="form-control" data-validation="required custom"  data-validation-regexp="^[a-zA-Z ]+$" value="{{ old('orgao_exp') }}">
					</div>	

				</div>

			</div>
		</div>
	</div>


	<div class="col-lg-12 well">
		<div class="row">
			<div class="col-sm-12">

				<div class="row">
					<div class="col-sm-10 form-group">
						<label>Email<span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="email" class="form-control"  data-validation="required email" value="{{ old('email') }}">
					</div>
				</div>

				<div class="row" id="dynamic_field">
					<div class="col-sm-4 form-group">
						<label>Tipo de Telefone<span class="asterisk">*</span></label>
						<select class="form-control" name="id_tp_telefone[]" data-validation="required">
							<option value="">Selecione</option>
							@foreach($tp_tel as $tels)
							<option value="{{$tels->id_tp_telefone}}">{{$tels->tp_telefone}}</option>
							@endforeach
						</select>
					</div>	

					<div class="col-sm-4 form-group" >
						<label>Telefone<span class="asterisk">*</span></label>
						<input class="form-control phone_with_ddd telefone" type="text" name="telefone[]" data-validation="required">
					</div>

					<div class="col-sm-4 form-group" style="padding-top: 29px; padding-left: 35px;">
						<a name="add" id="add" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i></a>
					</div>
					
				</div>

			</div>
		</div>
	</div>


	<div class="col-lg-12 well">
		<div class="row">
			<div class="col-sm-12">

				<div class="row">

					<div class="col-sm-3 form-group">
						<label>CEP<span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="cep" id="cep" class="form-control cep" data-validation="required cep" value="{{ old('cep') }}">
					</div>

					<div class="col-sm-7 form-group">
						<label>Logradouro<span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="logradouro" id="rua" class="form-control" data-validation="required" value="{{ old('logradouro') }}">
					</div>
					<div class="col-sm-2 form-group null">
						<label>Número</label>
						<input type="text" placeholder="" name="numero" class="form-control" value="{{ old('numero') }}">
					</div>

				</div>

				<div class="row">

					<div class="col-sm-4 form-group">
						<label>Cidade<span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="cidade" id="cidade" class="form-control" value="{{ old('cidade') }}" data-validation="required" >
					</div>

					<div class="col-sm-2 form-group">
						<label>UF<span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="uf" id="uf" class="form-control" data-validation="required" value="{{ old('uf') }}">
					</div>

					<div class="col-sm-4 form-group">
						<label>Bairro<span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="bairro" id="bairro" class="form-control"  data-validation="required" value="{{ old('bairro') }}">
					</div>
				</div>

				<div class="row">
					<div class="col-sm-12 form-group">
						<label>Complemento</label>
						<input type="text" placeholder="" name="complemento" class="form-control" value="{{ old('complemento') }}" >
					</div>	
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-12 well">
		<div class="row">
			<div class="col-sm-12">

				<div class="form-group">
					<label>CBO - Profissão</label>
					<select class="single-select form-control" name="id_profissao" style="width: 100%;">
						<option value=""></option>
						@foreach($profissao as $profs)
						<option value="{{$profs->id_profissao}}" class="special" data-width="fit">{{$profs->cbo}} - {{$profs->nm_profissao}}</option>
						@endforeach
					</select>
				</div>

				<div class="row">
					<div class="col-sm-4 form-group" >
						<label>CTPS - Número</label>
						<input type="text" name="ctps" class="form-control" value="{{ old('ctps') }}" placeholder="Número">
					</div>
					<div class="col-sm-3 form-group" >
						<label>CTPS - Série</label>
						<input type="text" name="serie_ctps" class="form-control ctps_serie" value="{{ old('serie_ctps') }}" placeholder="Série">
					</div>
					<div class="col-sm-3 form-group" >
						<label>Remuneração (R$)</label>
						<input type="text" name="" class="form-control money text-right real" value="{{ old('remuneracao') }}">
						<input type="text" name="remuneracao" class="valorV">  
					</div>
				</div>
			</div>
		</div>
	</div>

	<br>
	<div class="form-group">
		<p><b><span class="asterisk">*</span>Campos de Preenchimento Obrigatórios </b><br><br></p>
	</div>


	<div class="text-center">
		<a href="{{ URL::to('/pessoa/verify') }}" class="btn btn-lg btn-danger">Voltar <i class="fa fa-undo" aria-hidden="true"></i></a>
		&nbsp;&nbsp;&nbsp;
		<button type="submit" class="btn btn-lg btn-info">Cadastrar <i class="fa fa-plus" aria-hidden="true"></i></button>
	</div>
	<br>
	<br>
</div> 

{!! Form::close() !!}
@endsection

@section('content_js')
<script src="{{asset('../resources/assets/js/actions/parte.js')}}" type="text/javascript"></script>
<script type="text/javascript">
	
	$(document).ready(function() {
		var i=1;  
		var maxField = 3;
		$('#add').click(function(){  
			$('.phone_with_ddd').mask('(00) 0000-00000');
			if(i < maxField){ 
				i++;  
				$('#dynamic_field').after('<div class="row" id="row'+i+'"><div class="col-sm-4 form-group"><label>Tipo de Telefone</label><select class="form-control" name="id_tp_telefone[]" data-validation="required"><option value="">Selecione</option><?php foreach ($tp_tel as $tels){ ?><option value="{{$tels->id_tp_telefone}}">{{$tels->tp_telefone}}</option> <?php } ?></select></div><div class="col-sm-4 form-group" ><label>Telefone</label><input class="form-control phone_with_ddd telefone" type="text" name="telefone[]"></div><div class="col-sm-4 form-group" style="padding-top: 29px; padding-left: 35px;"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-times" aria-hidden="true"></i></button></div></div>');  
				$('.phone_with_ddd').mask('(00) 0000-00000');
			}
		});  
		$(document).on('click', '.btn_remove', function(){  
			var button_id = $(this).attr("id");   
			$('#row'+button_id+'').remove(); 
			i--; 
		});  
	});
</script>
@endsection