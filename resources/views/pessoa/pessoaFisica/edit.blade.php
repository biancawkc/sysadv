@extends('layouts.master2')

@section('content')
@if($errors->any())
<ul class="alert alert-danger">
	@foreach($errors->all() as $error)
	<li>{{$error}}</li>
	@endforeach
</ul>
@endif
{!! Form::open(['route'=>['fisica.update', $pessoaFisica->id_parte], 'method'=>'put', 'class'=>'form']) !!}
@include('flash::message')
<div class="container-custom">
	<input type="hidden" name="ativo" value="1">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<h1 class="col-lg-12 well "> Editar Pessoa Física <i class="fa fa-user-plus user-plus" aria-hidden="true"></i>
	</h1>

	<div class="col-lg-12 well">
		<div class="row">
			<div class="col-sm-12">

				<div class="form-group">
					<label>Nome Completo<span class="asterisk">*</span></label>
					<input type="text" placeholder="" name="nome" class="form-control"  data-validation="required" value="{{$pessoaFisica->nome}}">
				</div>


				<div class="row">

					<div class="col-sm-4 form-group">
						<label>Data Nasc.<span class="asterisk">*</span></label>
							<input name="dt_nasc" type="text" class="form-control date-picker datepicker date" data-date-format="dd/mm/yyyy" data-validation="date" data-validation-format="dd/mm/yyyy" placeholder="dd/mm/aaaa" value="{{$dtNasc}}">
					</div>


					<div class="col-sm-4 form-group">
						<label>Estado Civil<span class="asterisk">*</span></label>
						<select class="form-control" name="id_estado_civil" data-validation="required" id="estado_civil">
							<option value="">Selecione</option>
							@foreach($civil as $civ)
							<option value="{{$civ->id_estado_civil}}">{{$civ->desc_estado_civil}}</option>
							@endforeach
						</select>
					</div>


					<div class="col-sm-4 form-group">
						<label>CPF<span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="cpf" class="form-control cpf" value="{{$pessoaFisica->cpf}}" readonly data-validation="required" id="cpf">
					</div>

				</div>

				<div class="row">


					<div class="col-sm-4 form-group">
						<label>RG<span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="rg" class="form-control rg" value="{{$pessoaFisica->rg}}" data-validation="required" id="rg">
					</div>


					<div class="col-sm-2 form-group">
						<label>Órg. Emiss.<span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="orgao_exp" class="form-control" value="{{$pessoaFisica->orgao_exp}}" data-validation="required" >
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
						<input type="text" placeholder="" name="email" class="form-control"  data-validation="required email" value="{{$parte->email}}">
					</div>
				</div>

				<div class="row" id="telefones">
					<div class="col-sm-4 form-group">
						<label>Tipo de Telefone<span class="asterisk">*</span></label>
						<select class="form-control" name="id_tp_telefone" data-validation="required">
							<option value="">Selecione</option>
							@foreach($tp_tel as $tels)
							<option value="{{$tels->id_tp_telefone}}">{{$tels->tp_telefone}}</option>
							@endforeach
						</select>
					</div>	

					<div class="col-sm-4 form-group" >
						<label>Telefone<span class="asterisk">*</span></label>
						<input type="text" name="telefone" class="form-control phone_with_ddd" data-validation="required" id="tel">
					</div>

					<div class="col-sm-4 form-group" style="padding-top: 32px; padding-left: 35px;">
						<a id="more_fields" class="btn btn-sm btn-success" onclick="add_fields();"> Mais <i class="fa fa-plus" aria-hidden="true"></i> </a>

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
						<input type="text" placeholder="" name="cep" id="cep" class="form-control cep" data-validation="required cep" value="{{$endereco->cep}}">
					</div>

					<div class="col-sm-7 form-group">
						<label>Logradouro<span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="logradouro" id="rua" class="form-control" data-validation="required" value="{{$endereco->logradouro}}">
					</div>
					<div class="col-sm-2 form-group null">
						<label>Número</label>
						<input type="text" placeholder="" name="numero" class="form-control" value="{{$endereco->numero}}">
					</div>

				</div>

				<div class="row">

					<div class="col-sm-4 form-group">
						<label>Cidade<span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="cidade" id="cidade" class="form-control" value="{{$endereco->cidade}}" data-validation="required" >
					</div>

					<div class="col-sm-2 form-group">
						<label>UF<span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="uf" id="uf" class="form-control" data-validation="required" value="{{$endereco->uf}}" >
					</div>

					<div class="col-sm-4 form-group">
						<label>Bairro<span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="bairro" id="bairro" class="form-control" data-validation="required" value="{{$endereco->bairro}}">
					</div>
				</div>

				<div class="row">
					

					<div class="col-sm-12 form-group">
						<label>Complemento</label>
						<input type="text" placeholder="" name="complemento" class="form-control" value="{{$endereco->complemento}}" >
					</div>	

				</div>

			</div>
		</div>
	</div>

	<div class="col-lg-12 well">
		<div class="row">
			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-4 form-group" >
						<label>CBO</label>
						<input type="text" name="cbo" class="form-control" value="{{$profissao->cbo}}">
					</div>

					<div class="col-sm-8 form-group">
						<label>Profissão</label>
						<input type="text" name="nm_profissao" class="form-control" value="{{$profissao->nm_profissao}}">
					</div>

				</div>

				<div class="row">
					<div class="col-sm-4 form-group" >
						<label>CTPS</label>
						<input type="text" name="ctps" class="form-control" value="{{$pessoaFisica->ctps}}">
					</div>

					<div class="col-sm-3 form-group" >
						<label>Remuneração (R$)</label>
						<input type="text" name="remuneracao" class="form-control" value="{{$profissao->remuneracao}}" >
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
		<a href="{{ URL::to('/pessoaFisica/' . $pessoaFisica->id_parte . '/show') }}" class="btn btn-lg btn-danger">Voltar <i class="fa fa-undo" aria-hidden="true"></i></a>
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

	//var tel = 2;
	function add_fields() {
	//	tel++;
	var objTo = document.getElementById('telefones')
	var divtest = document.createElement("div");

	divtest.innerHTML = '<div class="row"></div><div class="col-sm-3 form-group"><label>Tipo de Telefone: </label><select class="form-control" name="id_tp_telefone[]"><option>Selecione</option><option value="1">Celular</option><option value="2">Comercial</option><option value="3">Residencial</option></select></div><div class="col-sm-3 form-group" ><label>Telefone:</label> <input type="text" class="form-control" name="telefone[]" value="" /></div>';



	objTo.appendChild(divtest)
}

$est = {{$pessoaFisica->id_estado_civil}}
$("#estado_civil").val($est);

</script>

@endsection