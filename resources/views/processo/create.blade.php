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
<input type="hidden" value="0" name="justica_grat">
<input type="hidden" value="0" name="acao_grat">
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
						<input name="dt_inicio" type="text" class="form-control date dtIni" data-validation="date" data-validation-format="dd/mm/yyyy" placeholder="dd/mm/aaaa" readonly>

					</div>
				</div>


				<div class="col-sm-4 form-group null">
					<label>Data final</label>
					<div class="input-group add-on col-md-12" >
						<div class="input-group-btn">
							<a class="btn btn-default"><i class="fa fa-calendar"></i></a>
						</div>
						<input name="dt_final" type="text" class="form-control date dtFn" placeholder="dd/mm/aaaa"  data-validation="date" data-validation-format="dd/mm/yyyy" data-validation-optional="true" readonly id="dtFn">
					</div>
				</div>

				<div class="col-sm-1 form-group" style="padding-top: 28px; padding-left: -15px;">
					<a type="button" class="btn btn-md btn-info" id="clearDates" data-toggle="tooltip" data-placement="top" title="Limpar Data Final"><i class="fa fa-eraser" aria-hidden="true"></i></a>
				</div>


				<div class="col-sm-3 form-group" style="padding-left: 42px;">
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
				<div class="col-sm-8 form-group">
					<label>Advogado<span class="asterisk">*</span></label>

					<select class="form-control single-select" data-validation="required" name="id_advogado">
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
			<div class="row pessoa" id="cliente">
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
				<div class="col-sm-2 form-group" style="padding-top: 29px; padding-left: 40px;">
					<a  id="addCl" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i></a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-lg-12 well">
	<div class="row">
		<div class="col-sm-12">
			<div class="row pessoa" id="adversa">
				<div class="col-sm-10 form-group">
					<label>Parte adversa<span class="asterisk">*</span></label>
					<select class="form-control single-select" name="id_parte[]" data-validation="required">
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
				<div class="col-sm-2 form-group" style="padding-top: 29px; padding-left: 40px;">
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

				<div class="col-sm-4 form-group">
					<label>Justiça<span class="asterisk">*</span></label>
					<select name="id_justica" class="form-control single-select" data-validation="required">	
						<option value="">Selecione</option>
						@foreach($justicas as $justica)
						<option value="{{$justica->id_justica}}">{{$justica->nm_justica}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-sm-8 form-group">
					<label>Ação<span class="asterisk">*</span></label>
					<input type="text" name="nome_acao" class="form-control" data-validation="required" >
					
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
					<select name="id_vara" class="form-control single-select" data-validation="required">	
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
	<a href="{{ URL::to('processo/verify') }}" class="btn btn-lg btn-danger">Voltar <i class="fa fa-undo" aria-hidden="true"></i></a>
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

  var x=10;  
      $('#addCl').click(function(){  
           x++;  
           $('#cliente').after('<div class="row pessoa" id="cl'+x+'"> <div class="col-sm-10 form-group"><label>Cliente</label><select class="form-control single-select" name="id_parte[]" data-validation="required"><option value="">Selecione</option><?php foreach ($pessoaJuridica as $pj){ ?><option value="{{$pj->id_parte}}">{{$pj->razao_social}}</option> <?php } foreach ($pessoaFisica as $pf){ ?><option value="{{$pf->id_parte}}">{{$pf->nome}}</option> <?php }?></select><input type="hidden" name="participacao[]" value="c"></div> <div class="col-sm-2 form-group" style="padding-top: 27px; padding-left: 40px;"><a id="'+x+'" class="btn btn-danger btn_removeCl"><i class="fa fa-times" aria-hidden="true"></i></a></div></div>');  
           $(".single-select").select2({placeholder: "Selecione ou Digite", allowClear: true, theme: "bootstrap"});
      });  
      $(document).on('click', '.btn_removeCl', function(){  
           var button_id = $(this).attr("id");   
           $('#cl'+button_id+'').remove(); 
      });  


   var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#adversa').after('<div class="row pessoa" id="row'+i+'"> <div class="col-sm-10 form-group"><label>Parte adversa</label><select class="form-control single-select" name="id_parte[]" data-validation="required"><option value="">Selecione</option><?php foreach ($pessoaJuridica as $pj){ ?><option value="{{$pj->id_parte}}">{{$pj->razao_social}}</option> <?php } foreach ($pessoaFisica as $pf){ ?><option value="{{$pf->id_parte}}">{{$pf->nome}}</option> <?php }?></select><input type="hidden" name="participacao[]" value="a"></div> <div class="col-sm-2 form-group" style="padding-top: 27px; padding-left: 40px;"><a name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-times" aria-hidden="true"></i></a></div></div>');  
           $(".single-select").select2({placeholder: "Selecione ou Digite", allowClear: true, theme: "bootstrap"});
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove(); 
      });

      $('#clearDates').on('click', function(){
      	document.getElementById("dtFn").value= "";
      }); 

});

</script>

@endsection