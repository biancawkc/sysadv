@extends('layouts.master2')

@section('content')
@if($errors->any())
<ul class="alert alert-danger">
	@foreach($errors->all() as $error)
	<li>{{$error}}</li>
	@endforeach
</ul>
@endif
{!! Form::open(['route'=>'fisica.store', 'id'=>'clientForm' ]) !!}
@include('flash::message')
<div class="container-custom">
	<input type="hidden" name="ativo" value="1">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<h1 class="col-lg-12 well "> Editar Cadastro <i class="fa fa-check-square-o" aria-hidden="true"></i>
	</h1>

	<div class="col-lg-12 well">
		<div class="row">
			<div class="col-sm-12">

				<div class="form-group">
					<label>Nome Completo <span class="asterisk">*</span></label>
					<input type="text" placeholder="" name="nome" class="form-control" 
					data-validation="required" value="{{ $pessoaFisica->nome }}">
				</div>


				<div class="row">

					<div class="col-sm-3 form-group">
						<label>Data Nasc. <span class="asterisk">*</span></label>
						
						<input type='text' name="dt_nasc" class="form-control" />

					</div>


					<div class="col-sm-4 form-group">
						<label>Estado Civil <span class="asterisk">*</span></label>
						<select class="form-control" name="id_civil" data-validation="required">
							<option value="">Selecione</option>
							@foreach($civil as $civ)
							<option value="{{$civ->id_estado_civil}}">{{$civ->desc_estado_civil}}</option>
							@endforeach
						</select>
					</div>

				</div>

				<div class="row">

					<div class="col-sm-4 form-group">
						<label>CPF <span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="cpf" class="form-control cpf"  readonly data-validation="required" id="cpf"  value="{{ $pessoaFisica->cpf }}">
					</div>

					<div class="col-sm-4 form-group">
						<label>RG <span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="rg" class="form-control rg"  data-validation="required" id="rg"  value="{{$pessoaFisica->rg }}">
					</div>


					<div class="col-sm-2 form-group">
						<label>Órg. Emiss.<span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="orgao_exp" class="form-control"  data-validation="required"  value="{{ $pessoaFisica->orgao_exp }}">
					</div>	

				</div>

			</div>
		</div>
	</div>



	<div class="col-lg-12 well">
		<div class="row">
			<div class="col-sm-12">

				<div class="form-group">
					<label>Email <span class="asterisk">*</span></label>
					<input type="text" placeholder="" name="email" class="form-control" data-validation="required email" value="{{ $parte->email }}">
				</div>

				<div class="row" id="telefones">
					<div class="col-sm-3 form-group">
						<label>Tipo de Telefone <span class="asterisk">*</span></label>
						<select class="form-control" name="id_tp_telefone" data-validation="required" id="">
							<option value="">Selecione</option>
							@foreach($tp_tel as $tels)
							<option value="{{$tels->id_tp_telefone}}">{{$tels->tp_telefone}}</option>
							@endforeach
						</select>
					</div>	

					<div class="col-sm-3 form-group" >
						<label>Telefone <span class="asterisk">*</span></label>
						<input type="text" name="telefone" class="form-control phone_with_ddd" data-validation="required" id="tel">
					</div>
					<br>
					<br>
					<a id="more_fields"  onclick="add_fields();">Mais <i class="fa fa-plus" aria-hidden="true"></i></a>

				</div>

			</div>
		</div>
	</div>


	<div class="col-lg-12 well">
		<div class="row">
			<div class="col-sm-12">

				<div class="row">

					<div class="col-sm-4 form-group">
						<label>CEP <span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="cep" id="cep" class="form-control" data-validation="required cep" value="" >
					</div>


				</div>

				<div class="row">

					<div class="col-sm-2 form-group">
						<label>UF <span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="uf" id="uf" class="form-control" data-validation="required" value="">
					</div>

					<div class="col-sm-4 form-group">
						<label>Cidade <span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="cidade" id="cidade" class="form-control" data-validation="required" value="" >
					</div>

					<div class="col-sm-4 form-group">
						<label>Bairro <span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="bairro" id="bairro" class="form-control" data-validation="required" >
					</div>
				</div>

				<div class="row">
					<div class="col-sm-7 form-group">
						<label>Logradouro <span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="logradouro" id="rua" class="form-control"  data-validation="required" >
					</div>

					<div class="col-sm-5 form-group">
						<label>Complemento</label>
						<input type="text" placeholder="nº, apt, casa.." name="complemento" class="form-control" value="" >
					</div>	

				</div>

			</div>
		</div>
	</div>
	<div class="col-lg-12 well">
		<div class="row">
			<div class="col-sm-12">

				<div class="form-group">
					<label>Profissão</label>
					<input type="text" placeholder="" name="nm_profissao" class="form-control">
				</div>

				<div class="row">
				<div class="col-sm-4 form-group" >
					<label>CBO</label>
					<input type="text" name="cbo" class="form-control" id="tel">
				</div>
				<div class="col-sm-4 form-group" >
					<label>CTPS</label>
					<input type="text" name="ctps" class="form-control" id="tel">
				</div>

				<div class="col-sm-3 form-group" >
					<label>Remuneração </label>
					<input type="text" name="remuneracao" class="form-control" >
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
		<a href="{{ URL::to('/verify') }}" class="btn btn-lg btn-danger">Voltar <i class="fa fa-undo" aria-hidden="true"></i></a>
		&nbsp;&nbsp;&nbsp;
		<button type="submit" class="btn btn-lg btn-info">Editar <i class="fa fa-plus" aria-hidden="true"></i></button>
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


	//var tel = 2;
	function add_fields() {
	//	tel++;
	var objTo = document.getElementById('telefones')
	var divtest = document.createElement("div");

	divtest.innerHTML = '<div class="row"></div><div class="col-sm-3 form-group"><label>Tipo de Telefone: </label><select class="form-control" name="id_tp_telefone[]"><option>Selecione</option><option value="1">Celular</option><option value="2">Comercial</option><option value="3">Residencial</option></select></div><div class="col-sm-3 form-group" ><label>Telefone:</label> <input type="text" class="form-control" name="telefone[]" value="" /></div>';



	objTo.appendChild(divtest)
}





$("#clientForm").submit(function() {
	$("#cpf").unmask();
	$("#tel").unmask();
});

    $('#flash-overlay-modal').modal();

</script>

@endsection