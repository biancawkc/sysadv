@extends('layouts.master2')

@section('content')
@if($errors->any())
<ul class="alert alert-danger">
	@foreach($errors->all() as $error)
	<li>{{$error}}</li>
	@endforeach
</ul>
@endif
{!! Form::open(['route'=>'fisica.store', 'id'=>'colabForm' ]) !!}
@include('flash::message')
<div class="container-custom">
	<input type="hidden" name="ativo" value="0">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<h1 class="col-lg-12 well "> Cadastro de Pessoa Jurídica <i class="fa fa-user-plus user-plus" aria-hidden="true"></i>
	</h1>

	<div class="col-lg-12 well">
		<div class="row">
			<div class="col-sm-12">

				<div class="form-group">
					<label>Nome Fantasia</label>
					<input type="text" placeholder="" name="nome" class="form-control" autofocus>
				</div>

				<div class="form-group">
					<label>Razão Social <span class="asterisk">*</span></label>
					<input type="text" placeholder="" name="nome" class="form-control" autofocus>
				</div>


				<div class="row">

					<div class="col-sm-4 form-group">
						<label>CNPJ <span class="asterisk">*</span></label>						
						<input type='text' name="cnpj" class="form-control" data-validation="required" value="{{$cnpj}}" readonly />
					</div>


					<div class="col-sm-8 form-group">
						<label>Incrição Estadual <span class="asterisk">*</span></label>
						<input type='text' name="ins_estadual" class="form-control" data-validation="required"/>
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
					<label>Email <span class="asterisk">*</span></label>
					<input type="text" placeholder="" name="email" class="form-control"  data-validation="required email">
				</div>
			</div>

				<div class="row" id="telefones">
					<div class="col-sm-4 form-group">
						<label>Tipo de Telefone <span class="asterisk">*</span></label>
						<select class="form-control" name="id_tp_telefone" data-validation="required">
							<option value="">Selecione</option>
							@foreach($tp_tel as $tels)
							<option value="{{$tels->id_tp_telefone}}">{{$tels->tp_telefone}}</option>
							@endforeach
						</select>
					</div>	

					<div class="col-sm-4 form-group" >
						<label>Telefone <span class="asterisk">*</span></label>
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
						<label>CEP <span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="cep" id="cep" class="form-control" data-validation="required cep" >
					</div>

					<div class="col-sm-7 form-group">
						<label>Logradouro <span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="logradouro" id="rua" class="form-control" value="" data-validation="required" >
					</div>
						<div class="col-sm-2 form-group">
						<label>Número <span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="numero" class="form-control" value="" data-validation="required" >
					</div>

				</div>

				<div class="row">

					<div class="col-sm-4 form-group">
						<label>Cidade <span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="cidade" id="cidade" class="form-control" value="" data-validation="required" >
					</div>

					<div class="col-sm-2 form-group">
						<label>UF <span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="uf" id="uf" class="form-control" data-validation="required" >
					</div>

					<div class="col-sm-4 form-group">
						<label>Bairro <span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="bairro" id="bairro" class="form-control" value="" data-validation="required" >
					</div>
				</div>

				<div class="row">
					

					<div class="col-sm-12 form-group">
						<label>Complemento</label>
						<input type="text" placeholder="" name="complemento" class="form-control" value="" >
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


	var tel = 1;
	var wrapper         = $(".input_fields_wrap"); //Fields wrapper
	function add_fields() {
		tel++;
		var objTo = document.getElementById('telefones')
		var divtest = document.createElement("div");


		divtest.innerHTML = '<div class="row input_fields_wrap"></div><div class="col-sm-3 form-group"><label>Tipo de Telefone: </label><select class="form-control" name="id_tp_telefone"><option>Selecione</option><option value="1">Celular</option><option value="2">Comercial</option><option value="3">Residencial</option></select></div><div class="col-sm-3 form-group" ><label>Telefone:</label> <input type="text" class="form-control" name="telefone[]" value="" /></div>';

		if(tel < 4){ 
		objTo.appendChild(divtest)
	}
	}


/*	$(document).ready(function() {
    var max_fields      = 3; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="remove_field">X</a></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});*/


	$("#colabForm").submit(function() {
		$("#cpf").unmask();
	});



</script>

@endsection