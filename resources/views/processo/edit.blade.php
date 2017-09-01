@extends('layouts.master2')

@section('content')
@if($errors->any())
<ul class="alert alert-danger">
	@foreach($errors->all() as $error)
	<li>{{$error}}</li>
	@endforeach
</ul>
@endif
{!! Form::open(['route'=>['processo.update', $processo->id_processo], 'method'=>'put', 'class'=>'form']) !!}
@include('flash::message')
<input type="hidden" name="id_estado_processo" value="1">
<div class="container-custom">
	<input type="hidden" name="ativo" value="0">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<h1 class="col-lg-12 well "> Editar Processo <i class="fa fa-file processo" aria-hidden="true"></i>
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
						<input name="dt_inicio" type="text" class="form-control date-picker datepicker date" data-date-format="dd/mm/yyyy" data-validation="date" data-validation-format="dd/mm/yyyy" placeholder="dd/mm/aaaa" value="{{date('d/m/Y', strtotime($processo->dt_inicio))}}">

					</div>
				</div>


				<div class="col-sm-4 form-group null">
					<label>Data final</label>
					<div class="input-group add-on col-md-12" >
						<div class="input-group-btn">
							<a class="btn btn-default"><i class="fa fa-calendar"></i></a>
						</div>
						<input name="dt_inicio" type="text" class="form-control date-picker datepicker date" data-date-format="dd/mm/yyyy" data-validation="date" data-validation-format="dd/mm/yyyy" placeholder="dd/mm/aaaa" value="{{date('d/m/Y', strtotime($processo->dt_final))}}" data-validation-optional="true">
					</div>
				</div>

				<div class="col-sm-4 form-group" style="padding-left: 42px;">
					@if ($processo->justica_grat == 1)
					<input type="checkbox" value="1" name="justica_grat" checked>  Justiça gratuita
					@else
					<input type="checkbox" value="1" name="justica_grat">  Justiça gratuita
					@endif				
					<br>
					<br>
					@if ($processo->justica_grat == 1)
					<input type="checkbox" value="1" name="acao_grat" checked>  Ação sem valor
					@else
					<input type="checkbox" value="1" name="acao_grat">  Ação sem valor
					@endif
				</div>

			</div>

			<div class="row">
				<div class="col-sm-4 form-group">
					<label>Número do Processo<span class="asterisk">*</span></label>						
					<input type='text' name="numero" class="form-control" data-validation="required" value="{{$processo->numero}}" readonly />
				</div>
				<div class="col-sm-7 form-group">
					<label>Advogado<span class="asterisk">*</span></label>

					<select class="form-control selectpicker" data-validation="required" data-live-search="true" name="id_advogado" id="advogado">
						<option>Selecione</option>
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
			@if(!$pessoaJuridicaC->isEmpty())
			@foreach($pessoaJuridicaC as $index=>$values)

			<div class="row">
				<div class="col-sm-10 form-group">
					<label>Cliente<span class="asterisk">*</span></label>
					<select class="form-control selectpicker" name="id_parte[]" data-validation="required" data-live-search="true">
						<option value="{{$values->id_parte}}" selected>{{$values->razao_social}}</option>
						@foreach($pessoaFisica as $pf)
						<option value="{{$pf->id_parte}}">{{$pf->nome}}</option>
						@endforeach
						@foreach($pessoaJuridica as $pj)
						@if( $pj->id_parte !== $values->id_parte)
						<option value="{{$pj->id_parte}}">{{$pj->razao_social}}</option>
						@endif
						@endforeach
					</select>
					<input type="hidden" name="participacao[]" value="c">
				</div>
				<div class="col-sm-2 form-group" style="padding-top: 32px; padding-left: 19px;">
				@if($index !== 0)
					<a class="btn btn-sm btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a> &nbsp;&nbsp;
				@endif
					<a id="more_fields" class="btn btn-sm btn-success" onclick="add_fields();"><i class="fa fa-plus" aria-hidden="true"></i> </a>

				</div>
			</div>

			@endforeach
			@endif

			@if(!$pessoaFisicaC->isEmpty())
			@foreach($pessoaFisicaC as $ind=>$value)

			<div class="row">
				<div class="col-sm-10 form-group">
					<label>Cliente<span class="asterisk">*</span></label>
					<select class="form-control selectpicker" name="id_parte[]" data-validation="required" data-live-search="true">
						<option value="{{$value->id_parte}}" selected>{{$value->nome}}</option>
						@foreach($pessoaFisica as $pf)
						@if( $pf->id_parte !== $value->id_parte)
						<option value="{{$pf->id_parte}}">{{$pf->nome}}</option>
						@endif
						@endforeach
						@foreach($pessoaJuridica as $pj)
						<option value="{{$pj->id_parte}}">{{$pj->razao_social}}</option>
						@endforeach
					</select>
					<input type="hidden" name="participacao[]" value="c">
				</div>
				<div class="col-sm-2 form-group" style="padding-top: 32px; padding-left: 19px;">
				@if(!$pessoaJuridicaC->isEmpty())
					<a class="btn btn-sm btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a> &nbsp;&nbsp;
				@elseif($pessoaJuridicaC->isEmpty() && $ind !== 0)
					<a class="btn btn-sm btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a> &nbsp;&nbsp;
				@endif
					<a id="more_fields" class="btn btn-sm btn-success" onclick="add_fields();"><i class="fa fa-plus" aria-hidden="true"></i> </a>
				</div>
			</div>

			@endforeach
			@endif


		</div>
	</div>
</div>

<div class="col-lg-12 well">
	<div class="row">
		<div class="col-sm-12">
			@if(!$pessoaJuridicaA->isEmpty())
			@foreach($pessoaJuridicaA as $index=>$values)

			<div class="row">
				<div class="col-sm-10 form-group">
					<label>Parte adversa<span class="asterisk">*</span></label>
					<select class="form-control selectpicker" name="id_parte[]" data-validation="required" data-live-search="true">
						<option value="{{$values->id_parte}}" selected>{{$values->razao_social}}</option>
						@foreach($pessoaFisica as $pf)
						<option value="{{$pf->id_parte}}">{{$pf->nome}}</option>
						@endforeach
						@foreach($pessoaJuridica as $pj)
						@if( $pj->id_parte !== $values->id_parte)
						<option value="{{$pj->id_parte}}">{{$pj->razao_social}}</option>
						@endif
						@endforeach
					</select>
					<input type="hidden" name="participacao[]" value="a">
				</div>
				<div class="col-sm-2 form-group" style="padding-top: 32px; padding-left: 19px;">
				@if($index !== 0)
					<a href="javascript:void(0);" class="btn btn-sm btn-danger remove_button"><i class="fa fa-times" aria-hidden="true"></i></a> &nbsp;&nbsp;
				@elseif($index == 0)
					<a href="javascript:void(0);" class="btn btn-sm btn-success add_button" ><i class="fa fa-plus" aria-hidden="true"></i> </a>
				@endif
				</div>
			</div>

			@endforeach
			@endif

			@if(!$pessoaFisicaA->isEmpty())
			@foreach($pessoaFisicaA as $ind=>$value)
			<div class="adversa">
			<div class="row">
				<div class="col-sm-10 form-group">
					<label>Parte adversa<span class="asterisk">*</span></label>
					<select class="form-control selectpicker" name="id_parte[]" data-validation="required" data-live-search="true">
						<option value="{{$value->id_parte}}" selected>{{$value->nome}}</option>
						@foreach($pessoaFisica as $pf)
						@if( $pf->id_parte !== $value->id_parte)
						<option value="{{$pf->id_parte}}">{{$pf->nome}}</option>
						@endif
						@endforeach
						@foreach($pessoaJuridica as $pj)
						<option value="{{$pj->id_parte}}">{{$pj->razao_social}}</option>
						@endforeach
					</select>
					<input type="hidden" name="participacao[]" value="a">
				</div>
				<div class="col-sm-2 form-group" style="padding-top: 32px; padding-left: 19px;">
				@if($pessoaJuridicaA->isEmpty() && $ind == 0)
					<a href="javascript:void(0);" class="btn btn-sm btn-success add_button" ><i class="fa fa-plus" aria-hidden="true"></i> </a> &nbsp;&nbsp;
				@elseif(!$pessoaJuridicaA->isEmpty() || $ind !== 0)
					<a href="javascript:void(0);" class="remove_button" ><i class="fa fa-times" aria-hidden="true"></i></a>
				@endif
				</div>
			</div>
			</div>

			@endforeach
			@endif


		</div>
	</div>
</div>

<div class="col-lg-12 well">
	<div class="row">
		<div class="col-sm-12">
			<div class="row">

				<div class="col-sm-5 form-group">
					<label>Justiça<span class="asterisk">*</span></label>
					<select name="id_justica" class="form-control selectpicker" data-validation="required" data-live-search="true" id="justica">	
						<option value="">Selecione</option>
						@foreach($justicas as $justica)
						<option value="{{$justica->id_justica}}">{{$justica->nm_justica}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-sm-7 form-group">
					<label>Ação<span class="asterisk">*</span></label>
					<input type="text" name="nome_acao" class="form-control" value="{{$processo->nome_acao}}">
					
				</div>
			</div>

			<div class="form-group">

				<label>Comarca<span class="asterisk">*</span></label>
				<select name="id_comarca" class="form-control selectpicker" data-validation="required" data-live-search="true" id="comarca">
					<option value="">Selecione</option>
					@foreach($comarcas as $comarca)
					<option value="{{$comarca->id_comarca}}">{{$comarca->comarca}}</option>
					@endforeach
				</select>
			</div>


			<div class="form-group">
				<label>Vara<span class="asterisk">*</span></label>
				<input type="text" placeholder="" name="vara" class="form-control" data-validation="required"  value="{{$processo->vara}}">
			</div>


			<div class="form-group">
				<label>Descrição<span class="asterisk">*</span></label>
				<textarea class="form-control" rows="5" name="desc_processo" data-validation="required">{{$processo->desc_processo}}</textarea>
			</div>

		</div>
	</div>
</div>

<br>

<div class="form-group">
	<p><b><span class="asterisk">*</span>Campos de Preenchimento Obrigatórios </b><br><br></p>
</div>


<div class="text-center">
	<a href="{{ URL::to('/processo/'.$processo->id_processo.'/show') }}" class="btn btn-lg btn-danger">Voltar <i class="fa fa-undo" aria-hidden="true"></i></a>
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

	/*$('select').select2();*/
	$jus = {{$processo->id_justica}}
	$("#justica").val($jus);

	$comarca = {{$processo->id_comarca}}
	$("#comarca").val($comarca);

	$advogado = {{$processo->id_advogado}}
	$("#advogado").val($advogado);


$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.adversa'); //Input field wrapper
    var fieldHTML = '<div class="row"> <div class="col-sm-10 form-group"><label>Parte adversa</label><select class="form-control selectpicker" data-live-search="true" name="id_parte[]"><option>Selecione</option><?php foreach ($pessoaJuridica as $pj){ ?><option value="{{$pj->id_parte}}">{{$pj->razao_social}}</option> <?php } foreach ($pessoaFisica as $pf){ ?><option value="{{$pf->id_parte}}">{{$pf->nome}}</option> <?php }?></select><input type="hidden" name="participacao[]" value="a"></div> <div class="col-sm-2 form-group" style="padding-top: 32px; padding-left: 19px;"><a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fa fa-times" aria-hidden="true"></i></a></div></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    $(addButton).click(function(){ //Once add button is clicked
        if(x < maxField){ //Check maximum number of input fields
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); // Add field html
            $('.selectpicker').selectpicker('refresh');
        }
    });
    $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
    	//$("#adversaSelect").val('');
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
    
</script>

@endsection