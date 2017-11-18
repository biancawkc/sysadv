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
						@if ($processo->acao_grat == 1)
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

	@if(!$pessoaJuridicaC->isEmpty())
	@foreach($pessoaJuridicaC as $index=>$values)
	@if($index == 0)
	<div class="col-lg-12 well" id="cliente">
		@else
		<div class="col-lg-12 well"  id="row00{{$index}}">
			@endif
			<div class="row">
				<div class="col-sm-12">

					<div class="row">

						<div class="col-sm-10 form-group">
							<label>Cliente<span class="asterisk">*</span></label>
							<select class="form-control single-select pessoa cliente" name="id_parte[]" data-validation="required" id="c{{$index}}">
								<optgroup label="Pessoa Jurídica">
								<option value="{{$values->id_parte}}" selected class="pj">{{$values->razao_social}}</option>
								@foreach($pessoaJuridica as $pj)
								@if( $pj->id_parte !== $values->id_parte)
								<option value="{{$pj->id_parte}}" class="pj">{{$pj->razao_social}}</option>
								@endif
								@endforeach
								</optgroup>
								<optgroup label="Pessoa Física">
								@foreach($pessoaFisica as $pf)
								<option value="{{$pf->id_parte}}" class="pf">{{$pf->nome}}</option>
								@endforeach
								</optgroup>
							</select>
							<input type="hidden" name="participacao[]" value="c">
						</div>
						<div class="col-sm-2 form-group" style="padding-top: 32px; padding-left: 40px;">
							@if($index !== 0)
							<button type="button" name="remove" id="00{{$index}}" class="btn btn-danger btn_remove"><i class="fa fa-times" aria-hidden="true"></i></button> &nbsp;&nbsp;
							@else
							<a id="addCl" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i></a>
							@endif
						</div>
					</div>
					<div class="row c{{$index}}">
						<div class="col-sm-10 form-group">
							<label>Responsável do processo</label>
							<select class="form-control single-select" name="id_responsavel[]" id="rc{{$index}}">	
								@if(!is_null($values->id_responsavel))
								<option value="{{$values->id_responsavel}}" selected>{{$values->nome}}</option>
								@endif
								<option value="">Selecione</option>
								@foreach($pessoaFisica as $pf)
								<option value="{{$pf->id_parte}}">{{$pf->nome}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endforeach
		@endif

		@if(!$pessoaFisicaC->isEmpty())
		@foreach($pessoaFisicaC as $ind=>$value)
		@if($pessoaJuridicaC->isEmpty() && $ind == 0)
		<div class="col-lg-12 well" id="cliente">
			@else
			<div class="col-lg-12 well"  id="row01{{$ind}}">
				@endif
				<div class="row">
					<div class="col-sm-12">
						<div class="row">

							<div class="col-sm-10 form-group">
								<label>Cliente<span class="asterisk">*</span></label>
								<select class="form-control single-select pessoa cliente" name="id_parte[]" data-validation="required">
									<optgroup label="Pessoa Jurídica" id="cf{{$ind}}">
									<option value="{{$value->id_parte}}" selected class="pf">{{$value->nome}}</option>
									@foreach($pessoaJuridica as $pj)
									<option value="{{$pj->id_parte}}" class="pj">{{$pj->razao_social}}</option>
									@endforeach
								</optgroup>
									<optgroup label="Pessoa Física">
									@foreach($pessoaFisica as $pf)
									@if( $pf->id_parte !== $value->id_parte)
									<option value="{{$pf->id_parte}}" class="pf">{{$pf->nome}}</option>
									@endif
									@endforeach
								</optgroup>
								</select>
								<input type="hidden" name="participacao[]" value="c">
							</div>
							<div class="col-sm-2 form-group" style="padding-top: 32px; padding-left: 40px;">
								@if(!$pessoaJuridicaC->isEmpty())
								<button type="button" name="remove" id="01{{$index}}" class="btn btn-danger btn_remove"><i class="fa fa-times" aria-hidden="true"></i></button> &nbsp;&nbsp;
								@elseif($pessoaJuridicaC->isEmpty() && $ind !== 0)
								<button type="button" name="remove" id="01{{$index}}" class="btn btn-danger btn_remove"><i class="fa fa-times" aria-hidden="true"></i></button> &nbsp;&nbsp;
								@elseif($pessoaJuridicaC->isEmpty() && $ind == 0)
								<a id="addCl" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i></a>
								@endif
							</div>
						</div>
						<div class="row cf{{$ind}}">
						<div class="col-sm-10 form-group">
							<label>Responsável do processo</label>
							<select class="form-control single-select" name="id_responsavel[]" id="rcf{{$ind}}">	
								@if(!is_null($value->id_responsavel))
								<option value="{{$value->id_responsavel}}" selected>{{$value->nome}}</option>
								@endif
								<option value="">Selecione</option>
								@foreach($pessoaFisica as $pf)
								<option value="{{$pf->id_parte}}">{{$pf->nome}}</option>
								@endforeach
							</select>
						</div>
					</div>
					</div>
				</div>
			</div>

			@endforeach
			@endif

			@if(!$pessoaJuridicaA->isEmpty())
			@foreach($pessoaJuridicaA as $index=>$values)
			@if($index == 0)
			<div class="col-lg-12 well" id="adversa">
				@else
				<div class="col-lg-12 well"  id="row1{{$index}}">
					@endif
					<div class="row">
						<div class="col-sm-12">

							<div class="row" >

								<div class="col-sm-10 form-group">
									<label>Parte adversa<span class="asterisk">*</span></label>
									<select class="form-control single-select pessoa adversa" name="id_parte[]" data-validation="required" id="pa{{$index}}">
										<optgroup label="Pessoa Jurídica">
										<option value="{{$values->id_parte}}" selected class="pj">{{$values->razao_social}}</option>
										@foreach($pessoaJuridica as $pj)
										@if( $pj->id_parte !== $values->id_parte)
										<option value="{{$pj->id_parte}}" class="pj">{{$pj->razao_social}}</option>
										@endif
										@endforeach
									</optgroup>
										<optgroup label="Pessoa Física">
										@foreach($pessoaFisica as $pf)
										<option value="{{$pf->id_parte}}" class="pf">{{$pf->nome}}</option>
										@endforeach
									</optgroup>
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
							<div class="row pa{{$index}}">
							<div class="col-sm-10 form-group">
							<label>Responsável do processo</label>
							<select class="form-control single-select" name="id_responsavel[]" id="rpa{{$index}}">	
								@if(!is_null($values->id_responsavel))
								<option value="{{$values->id_responsavel}}" selected>{{$values->nome}}</option>
								@endif
								<option value="">Selecione</option>
								@foreach($pessoaFisica as $pf)
								<option value="{{$pf->id_parte}}">{{$pf->nome}}</option>
								@endforeach
							</select>
						</div>
					</div>
						</div>
					</div>
				</div>

				@endforeach
				@endif

				@if(!$pessoaFisicaA->isEmpty())
				@foreach($pessoaFisicaA as $ind=>$value)
				@if($pessoaJuridicaA->isEmpty() && $ind == 0)
				<div class="col-lg-12 well" id="adversa">
					@else
					<div class="col-lg-12 well"  id="row0{{$ind}}">
						@endif	
						<div class="row">
							<div class="col-sm-12">

								<div class="row" >
									<div class="col-sm-10 form-group">
										<label>Parte adversa<span class="asterisk">*</span></label>
										<select class="form-control single-select pessoa adversa" name="id_parte[]" data-validation="required" id="ap{{$index}}">
											<optgroup label="Pessoa Jurídica">
											<option value="{{$value->id_parte}}" selected class="pf">{{$value->nome}}</option>
											@foreach($pessoaJuridica as $pj)
											<option value="{{$pj->id_parte}}" class="pj">{{$pj->razao_social}}</option>
											@endforeach
										</optgroup>
										<optgroup label="Pessoa Física">
											@foreach($pessoaFisica as $pf)
											@if( $pf->id_parte !== $value->id_parte)
											<option value="{{$pf->id_parte}}" class="pf">{{$pf->nome}}</option>
											@endif
											@endforeach
										</optgroup>
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
								<div class="row ap{{$index}}">
									<div class="col-sm-10 form-group">
										<label>Responsável do processo</label>
										<select class="form-control single-select" name="id_responsavel[]" id="rap{{$index}}">	
											@if(!is_null($values->id_responsavel))
											<option value="{{$values->id_responsavel}}" selected>{{$values->nome}}</option>
											@endif
											<option value="">Selecione</option>
											@foreach($pessoaFisica as $pf)
											<option value="{{$pf->id_parte}}">{{$pf->nome}}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					@endforeach
					@endif
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
									<div class="form-group col-sm-6">
										<label>Estado Processo<span class="asterisk">*</span></label>
										<select name="id_estado_processo" class="form-control single-select" data-validation="required" id="status">	
											<option value="">Selecione</option>
											@foreach($status as $state)
											<option value="{{$state->id_estado_processo}}">{{$state->desc_est_processo}}</option>
											@endforeach
										</select>
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
<script src="{{asset('../resources/assets/js/actions/processo_edit.js')}}" type="text/javascript"></script>
<script type="text/javascript" >

	$jus = {{$processo->id_justica}}
	$("#justica").val($jus);

	$comarca = {{$processo->id_comarca}}
	$("#comarca").val($comarca);

	$advogado = {{$processo->id_advogado}}
	$("#advogado").val($advogado);

	$vara = {{$processo->id_vara}}
	$("#vara").val($vara);

	$status = {{$processo->id_estado_processo}}
	$("#status").val($status);

	$(document).ready(function() {

		var x=10;  
		var n = 101;
		$('#addCl').click(function(){  
			x++;  
			n++;
			$('#cliente').after('<div class="col-lg-12 well" id="cl'+x+'"><div class="row"><div class="col-sm-12"><div class="row"> <div class="col-sm-10 form-group"><label>Cliente</label><select class="form-control single-select pessoa cliente" name="id_parte[]" data-validation="required" id="c'+n+'"><option value="">Selecione</option><optgroup label="Pessoa Jurídica"><?php foreach ($pessoaJuridica as $pj){ ?><option value="{{$pj->id_parte}}" class="pj">{{$pj->razao_social}}</option> <?php }?></optgroup><optgroup label="Pessoa Física"> <?php foreach ($pessoaFisica as $pf){ ?><option value="{{$pf->id_parte}}">{{$pf->nome}}</option> <?php }?></optgroup></select><input type="hidden" name="participacao[]" value="c"></div> <div class="col-sm-2 form-group" style="padding-top: 27px; padding-left: 40px;"><a id="'+x+'" class="btn btn-danger btn_removeCl"><i class="fa fa-times" aria-hidden="true"></i></a></div></div><div class="row partesProcesso c'+n+'"><div class="col-sm-10 form-group"><label>Responsável do processo</label><select class="form-control single-select" name="id_responsavel[]" data-validation="required" id="rc'+n+'"><option value="">Selecione</option>@foreach($pessoaFisica as $pf)<option value="{{$pf->id_parte}}">{{$pf->nome}}</option>@endforeach</select></div></div></div></div></div>'); 
			$(".single-select").select2({placeholder: "Selecione ou Digite", allowClear: true, theme: "bootstrap"});
		});  
		$(document).on('click', '.btn_removeCl', function(){  
			var button_id = $(this).attr("id");  
			$('#cl'+button_id+'').remove(); 
		});  


		var i=1;  
		var y = 101;
		$('#add').click(function(){  
			i++;
			y++;  
			$('#adversa').after('<div class="col-lg-12 well" id="row'+i+'"><div class="row"><div class="col-sm-12"><div class="row"> <div class="col-sm-10 form-group"><label>Parte adversa</label><select id="a'+y+'" class="form-control single-select pessoa adversa" name="id_parte[]" data-validation="required"><option value="">Selecione</option><optgroup label="Pessoa Jurídica"><?php foreach ($pessoaJuridica as $pj){ ?><option value="{{$pj->id_parte}}" class="pj">{{$pj->razao_social}}</option> <?php }?></optgroup> <optgroup label="Pessoa Física"><?php foreach ($pessoaFisica as $pf){ ?><option value="{{$pf->id_parte}}" class="pf">{{$pf->nome}}</option> <?php }?></optgroup></select><input type="hidden" name="participacao[]" value="a"></div> <div class="col-sm-2 form-group" style="padding-top: 27px; padding-left: 40px;"><a name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-times" aria-hidden="true"></i></a></div></div><div class="row a0 partesProcesso a'+y+'"><div class="col-sm-10 form-group"><label>Responsável do processo</label><select id="ra'+y+'"class="form-control single-select" name="id_responsavel[]" data-validation="required"><option value="">Selecione</option>@foreach($pessoaFisica as $pf)<option value="{{$pf->id_parte}}">{{$pf->nome}}</option>@endforeach</select></div></div></div></div></div>');  
			$(".single-select").select2({placeholder: "Selecione ou Digite", allowClear: true, theme: "bootstrap"});
		});  
		$(document).on('click', '.btn_remove', function(){  
			var button_id = $(this).attr("id");   
			$('#row'+button_id+'').remove(); 
		});

	});


</script>

@endsection