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
<div class="container-custom">
	<input type="hidden" value="0" name="justica_grat">
	<input type="hidden" value="0" name="acao_grat">
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
						<input name="dt_inicio" type="text" class="form-control date" data-validation="date" data-validation-format="dd/mm/yyyy" placeholder="dd/mm/aaaa" value="{{date('d/m/Y', strtotime($processo->dt_inicio))}}" id="dtIni" readonly>

					</div>
				</div>


				<div class="col-sm-4 form-group null">
					<label>Data final</label>
					<div class="input-group add-on col-md-12" >
						<div class="input-group-btn">
							<a class="btn btn-default"><i class="fa fa-calendar"></i></a>
						</div>
						<input name="dt_final" type="text" class="form-control date" data-validation="date" data-validation-format="dd/mm/yyyy" placeholder="dd/mm/aaaa" value="{{$dt_final}}" data-validation-optional="true" id="dtFn" readonly>
					</div>
				</div>
				<div class="col-sm-1 form-group" style="padding-top: 28px; padding-left: -15px;">
					<a type="button" class="btn btn-md btn-info" id="clearDates" data-toggle="tooltip" data-placement="top" title="Limpar Data Final"><i class="fa fa-eraser" aria-hidden="true"></i></a>
				</div>

				<div class="col-sm-3 form-group" style="padding-left: 42px;">
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

					<select class="form-control single-select" data-validation="required" name="id_advogado" id="advogado">
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

			@if($index == 0)
				<div class="row" id="cliente">
				@else
				<div class="row"  id="row00{{$index}}">
				@endif
				<div class="col-sm-10 form-group">
					<label>Cliente<span class="asterisk">*</span></label>
					<select class="form-control single-select" name="id_parte[]" data-validation="required" >
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
				<div class="col-sm-2 form-group" style="padding-top: 32px; padding-left: 40px;">
					@if($index !== 0)
					<button type="button" name="remove" id="00{{$index}}" class="btn btn-danger btn_remove"><i class="fa fa-times" aria-hidden="true"></i></button> &nbsp;&nbsp;
					@endif
					<a id="addCl" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i></a>
				</div>
			</div>

			@endforeach
			@endif

			@if(!$pessoaFisicaC->isEmpty())
			@foreach($pessoaFisicaC as $ind=>$value)

				@if($pessoaJuridicaC->isEmpty() && $ind == 0)
				<div class="row" id="cliente">
				@else
				<div class="row"  id="row01{{$ind}}">
				@endif
				<div class="col-sm-10 form-group">
					<label>Cliente<span class="asterisk">*</span></label>
					<select class="form-control single-select" name="id_parte[]" data-validation="required">
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
				<div class="col-sm-2 form-group" style="padding-top: 32px; padding-left: 40px;">
					@if(!$pessoaJuridicaC->isEmpty())
					<button type="button" name="remove" id="01{{$ind}}" class="btn btn-danger btn_remove"><i class="fa fa-times" aria-hidden="true"></i></button> &nbsp;&nbsp;
					@elseif($pessoaJuridicaC->isEmpty() && $ind !== 0)
					<button type="button" name="remove" id="01{{$ind}}" class="btn btn-danger btn_remove"><i class="fa fa-times" aria-hidden="true"></i></button> &nbsp;&nbsp;
					@elseif($pessoaJuridicaC->isEmpty() && $ind == 0)
					<a id="addCl" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i></a>
					@endif
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
			@if($index == 0)
			<div class="row" id="adversa">
				@else
				<div class="row"  id="row1{{$index}}">
					@endif
					<div class="col-sm-10 form-group">
						<label>Parte adversa<span class="asterisk">*</span></label>
						<select class="form-control single-select" name="id_parte[]" data-validation="required">
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
					<div class="col-sm-2 form-group" style="padding-top: 32px; padding-left: 40px;">
						@if($index !== 0)
						<button type="button" name="remove" id="1{{$index}}" class="btn btn-danger btn_remove"><i class="fa fa-times" aria-hidden="true"></i></button> &nbsp;&nbsp;
						@elseif($index == 0)
						<a name="add" id="add" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i></a>
						@endif
					</div>
				</div>

				@endforeach
				@endif

				@if(!$pessoaFisicaA->isEmpty())
				@foreach($pessoaFisicaA as $ind=>$value)
				@if($pessoaJuridicaA->isEmpty() && $ind == 0)
				<div class="row" id="adversa">
				@else
				<div class="row"  id="row0{{$ind}}">
				@endif	
					<div class="col-sm-10 form-group">
						<label>Parte adversa<span class="asterisk">*</span></label>
						<select class="form-control single-select" name="id_parte[]" data-validation="required">
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
					<div class="col-sm-2 form-group" style="padding-top: 32px; padding-left: 40px;">
						@if($pessoaJuridicaA->isEmpty() && $ind == 0)
						<a name="add" id="add" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i></a> &nbsp;&nbsp;
						@elseif(!$pessoaJuridicaA->isEmpty() || $ind !== 0)
						<button type="button" name="remove" id="0{{$ind}}" class="btn btn-danger btn_remove"><i class="fa fa-times" aria-hidden="true"></i></button>
						@endif
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
						<select name="id_justica" class="form-control single-select" data-validation="required" id="justica">	
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
					<select name="id_comarca" class="form-control single-select" data-validation="required" id="comarca">
						<option value="">Selecione</option>
						@foreach($comarcas as $comarca)
						<option value="{{$comarca->id_comarca}}">{{$comarca->comarca}}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group">
					<label>Vara<span class="asterisk">*</span></label>
					<select name="id_vara" class="form-control single-select" data-validation="required" id="vara">	
						<option value="">Selecione</option>
						@foreach($varas as $vara)
						<option value="{{$vara->id_vara}}">{{$vara->vara}}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group">
					<label>Descrição<span class="asterisk">*</span></label>
					<textarea class="form-control" rows="5" name="desc_processo" data-validation="required">{{$processo->desc_processo}}</textarea>
				</div>

			</div>
		</div>
	</div>
	<div class="col-lg-12 well">
		<div class="row">
			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-7 form-group">
						<label>Status do processo<span class="asterisk">*</span></label>

						<select class="form-control single-select" data-validation="required" name="id_estado_processo" id="status">
							<option value="">Selecione</option>
							@foreach($status as $stage)
							<option value="{{$stage->id_estado_processo}}">{{$stage->desc_est_processo}}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<p>Data de criação: {{date('d/m/Y H:i:s', strtotime($processo->dt_criacao))}} &nbsp;&nbsp;&nbsp; Última alteração feita em {{date('d/m/Y H:i:s', strtotime($processo->dt_atualizacao))}} por {{$usuario->username}} </p>

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

	$vara = {{$processo->id_vara}}
	$("#vara").val($vara);

	$status = {{$estadoProcesso->id_estado_processo}}
	$("#status").val($status);

	$(document).ready(function() {
		$(".single-select").select2( {placeholder: "Selecione ou Digite", allowClear: true, theme: "bootstrap"});

		  var x=10;  
      $('#addCl').click(function(){  
           x++;  
           $('#cliente').after('<div class="row" id="cl'+x+'"> <div class="col-sm-10 form-group"><label>Cliente</label><select class="form-control single-select" name="id_parte[]" data-validation="required"><option value="">Selecione</option><?php foreach ($pessoaJuridica as $pj){ ?><option value="{{$pj->id_parte}}">{{$pj->razao_social}}</option> <?php } foreach ($pessoaFisica as $pf){ ?><option value="{{$pf->id_parte}}">{{$pf->nome}}</option> <?php }?></select><input type="hidden" name="participacao[]" value="c"></div> <div class="col-sm-2 form-group" style="padding-top: 27px; padding-left: 40px;"><a id="'+x+'" class="btn btn-danger btn_removeCl"><i class="fa fa-times" aria-hidden="true"></i></a></div></div>');  
           $(".single-select").select2( {placeholder: "Selecione ou Digite", allowClear: true, theme: "bootstrap"});
      });  
      $(document).on('click', '.btn_removeCl', function(){  
           var button_id = $(this).attr("id");   
           $('#cl'+button_id+'').remove(); 
      });  


		var i=1;  
		$('#add').click(function(){  
			i++;  
			$('#adversa').after('<div class="row" id="row'+i+'"> <div class="col-sm-10 form-group"><label>Parte adversa</label><select class="form-control single-select" name="id_parte[]" data-validation="required"><option value="">Selecione</option><?php foreach ($pessoaJuridica as $pj){ ?><option value="{{$pj->id_parte}}">{{$pj->razao_social}}</option> <?php } foreach ($pessoaFisica as $pf){ ?><option value="{{$pf->id_parte}}">{{$pf->nome}}</option> <?php }?></select><input type="hidden" name="participacao[]" value="a"></div> <div class="col-sm-2 form-group" style="padding-top: 27px; padding-left: 40px;"><a name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-times" aria-hidden="true"></i></a></div></div>');  
			$(".single-select").select2( {placeholder: "Selecione ou Digite", allowClear: true, theme: "bootstrap"});
		});  
		$(document).on('click', '.btn_remove', function(){  
			var button_id = $(this).attr("id");   
			$('#row'+button_id+'').remove(); 
		});  

		/*$('#dtIni').datepicker({
				dateFormat: "dd/mm/yy",
				changeMonth: true,
				changeYear: true
			});*/

			$(document).on('focus', '#dtFn', function(){  

				var dtIni = document.getElementById("dtIni").value;
				$('#dtFn').datepicker({
					dateFormat: "dd/mm/yy",
					changeMonth: true,
					changeYear: true,
					minDate: dtIni
				});
			}); 
			$('#clearDates').on('click', function(){
				document.getElementById("dtFn").value= "";
			}); 


		});


</script>

@endsection