@extends('layouts.master2')

@section('content')
@if($errors->any())
<ul class="alert alert-danger">
	@foreach($errors->all() as $error)
	<li>{{$error}}</li>
	@endforeach
</ul>
@endif
{!! Form::open(['route'=>'processo.store', 'class'=>'form' ]) !!}
@include('flash::message')
<input type="hidden" name="id_estado_processo" value="1">
<div class="container-custom">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<h1 class="col-lg-12 well "> Cadastro de Processo <i class="fa fa-file processo" aria-hidden="true"></i>
	</h1>

	<div class="col-lg-12 well">
		<div class="row">
			<div class="col-sm-12">

				<div class="row">

					<div class="col-sm-4 form-group">
						<label>Data de início<span class="asterisk">*</span></label><div class="input-group add-on col-md-12" >
						<div class="input-group-btn">
							<a class="btn btn-default"><i class="fa fa-calendar"></i></a>
						</div>
						<input name="dt_inicio" type="text" class="form-control date-picker datepicker date" data-date-format="dd/mm/yyyy" data-validation="date" data-validation-format="dd/mm/yyyy" placeholder="dd/mm/aaaa">

					</div>
				</div>


				<div class="col-sm-4 form-group null">
					<label>Data final</label>
					<div class="input-group add-on col-md-12" >
						<div class="input-group-btn">
							<a class="btn btn-default"><i class="fa fa-calendar"></i></a>
						</div>
						<input name="dt_final" type="text" class="form-control date-picker datepicker date" placeholder="dd/mm/aaaa" data-date-format="dd/mm/yyyy" data-validation="date" data-validation-format="dd/mm/yyyy" data-validation-optional="true">

					</div>
				</div>

				<div class="col-sm-4 form-group" style="padding-left: 42px;">
					<input type="checkbox" value="1" name="justica_grat">  Justiça gratuita
					<br>
					<br>
					<input type="checkbox" value="1" name="acao_grat">  Ação sem valor
				</div>

			</div>

			<div class="row">
				<div class="col-sm-4 form-group">
					<label>Número do Processo<span class="asterisk">*</span></label>						
					<input type='text' name="numero" class="form-control" data-validation="required" value="{{$num}}" readonly />
				</div>
				<div class="col-sm-7 form-group">
					<label>Advogado<span class="asterisk">*</span></label>

					<select class="form-control single-select" data-validation="required" data-live-search="true" name="id_advogado">
						<option value="">Selecione</option>
						@foreach($advogados as $advogado)
						<option value="{{$advogado->id_advogado}}">{{$advogado->nome}}</option>
						@endforeach
					</select>
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
					<label>Cliente<span class="asterisk">*</span></label>
					<select class="form-control single-select" name="id_parte[]" data-validation="required" data-live-search="true">
						<option value="">Selecione</option>
						@foreach($pessoaFisica as $pf)
						<option value="{{$pf->id_parte}}">{{$pf->nome}}</option>
						@endforeach
						@foreach($pessoaJuridica as $pj)
						<option value="{{$pj->id_parte}}">{{$pj->razao_social}}</option>
						@endforeach
					</select>
					<input type="hidden" name="participacao[]" value="c">
				</div>
				<div class="col-sm-2 form-group" style="padding-top: 32px; padding-left: 40px;">
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
				<div class="col-sm-10 form-group">
					<label>Parte adversa<span class="asterisk">*</span></label>
					<select class="form-control single-select" name="id_parte[]" data-validation="required" data-live-search="true">
						<option value="">Selecione</option>
						@foreach($pessoaFisica as $pf)
						<option value="{{$pf->id_parte}}">{{$pf->nome}}</option>
						@endforeach
						@foreach($pessoaJuridica as $pj)
						<option value="{{$pj->id_parte}}">{{$pj->razao_social}}</option>
						@endforeach
					</select>
					<input type="hidden" name="participacao[]" value="a">
				</div>
				<div class="col-sm-2 form-group" style="padding-top: 32px; padding-left: 40px;">
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

				<div class="col-sm-4 form-group">
					<label>Justiça<span class="asterisk">*</span></label>
					<select name="id_justica" class="form-control single-select" data-validation="required" data-live-search="true">	
						<option value="">Selecione</option>
						@foreach($justicas as $justica)
						<option value="{{$justica->id_justica}}">{{$justica->nm_justica}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-sm-8 form-group">
					<label>Ação<span class="asterisk">*</span></label>
					<input type="text" name="nome_acao" class="form-control">
					
				</div>
			</div>

			<div class="form-group">

					<label>Comarca<span class="asterisk">*</span></label>
					<select name="id_comarca" class="form-control single-select" data-validation="required" data-live-search="true">
						<option value="">Selecione</option>
						@foreach($comarcas as $comarca)
						<option value="{{$comarca->id_comarca}}">{{$comarca->comarca}}</option>
						@endforeach
					</select>
				</div>


				<div class="form-group">
					<label>Vara<span class="asterisk">*</span></label>
					<select name="id_vara" class="form-control single-select" data-validation="required" data-live-search="true">	
						<option value="">Selecione</option>
						@foreach($varas as $vara)
						<option value="{{$vara->id_vara}}">{{$vara->vara}}</option>
						@endforeach
					</select>
				</div>



			<div class="form-group">

				<label>Descrição<span class="asterisk">*</span></label>
				<textarea class="form-control" rows="5" name="desc_processo" data-validation="required"></textarea>
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

{!! Form::close() !!}
@endsection

@section('content_js')
<script type="text/javascript" >
$(document).ready(function() {
  $(".single-select").select2( {placeholder: "Selecione ou Digite", allowClear: true, theme: "bootstrap"});
});


	/*$('select').select2();*/


	/*var tel = 1;
	var wrapper         = $(".input_fields_wrap"); //Fields wrapper
	function add_fields() {
		tel++;
		var objTo = document.getElementById('telefones')
		var divtest = document.createElement("div");


		divtest.innerHTML = '<div class="row input_fields_wrap"></div><div class="col-sm-3 form-group"><label>Tipo de Telefone: </label><select class="form-control" name="id_tp_telefone"><option>Selecione</option><option value="1">Celular</option><option value="2">Comercial</option><option value="3">Residencial</option></select></div><div class="col-sm-3 form-group" ><label>Telefone:</label> <input type="text" class="form-control" name="telefone[]" value="" /></div>';

		if(tel < 4){ 
			objTo.appendChild(divtest)
		}
	}*/


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

</script>

@endsection