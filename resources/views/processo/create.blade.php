@extends('layouts.master2')
@section('content')
<style type="text/css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
</style>
@if($errors->any())
<ul class="alert alert-danger">
	@foreach($errors->all() as $error)
	<li>{{$error}}</li>
	@endforeach
</ul>
@endif
{!! Form::open(['route'=>'processo.store', 'class'=>'form' ]) !!}
@include('flash::message')
<style type="text/css">
	.has-error .select2-selection {
    /*border: 1px solid #a94442;
    border-radius: 4px;*/
    border-color: #b94a48 !important;
    box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
}
</style>
<input type="hidden" name="id_estado_processo" value="1">
<input type="hidden" value="0" name="justica_grat">
<input type="hidden" value="0" name="acao_grat">
<div class="container-custom">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<h1 class="col-lg-12 well "> Cadastro de Processo <i class="fa fa-file processo" aria-hidden="true"></i><span class="pull-right questionMark"><i class="fa fa-question-circle help" aria-hidden="true"></i><span>
	</h1>
	<div class="modal fade helps" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title"><i class="fa fa-info-circle info" aria-hidden="true"></i> Informação</h3>
        </div>
        <div class="modal-body">
          <p><b>Justiça Gratuita</b>: quando selecionado, o processo será totalmente gratuito.<br><br>
          	 <b>Ação sem valor</b>: quando selecionado, não serão cobradas taxas da ação, apenas honorários.
          </p>
        </div>
      </div>  
    </div>
  </div>
  
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
			<div class="row" id="cliente">
				<div class="col-sm-10 form-group">
					<label>Cliente<span class="asterisk">*</span></label>
					<select class="form-control single-select pessoa cliente" name="id_parte[]" data-validation="required" >
						<option value="">Selecione</option>
						<optgroup label="Pessoa Jurídica">  
						@foreach($pessoaJuridica as $pj)
						<option value="{{$pj->id_parte}}" id="{{$pj->razao_social}}">{{$pj->razao_social}}</option>
						@endforeach
						</optgroup>
						<optgroup label="Pessoa Física">  
						@foreach($pessoaFisica as $pf)
						<option value="{{$pf->id_parte}}">{{$pf->nome}}</option>
						@endforeach
						</optgroup>
					</select>
					<input type="hidden" name="participacao[]" value="c">
				</div>
				<div class="col-sm-2 form-group" style="padding-top: 29px; padding-left: 40px;">
					<a  id="addCl" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Mais de um cliente"></i></a>
				</div>
			</div>
			<span id="respCliente"></span>
		<!-- 	<div class="row respCliente">
				<div class="col-sm-10 form-group">
					<label>Responsável - <span id="empresa"></span></label>
					<select class="form-control single-select" name="id_responsavel[]" data-validation="required" >
						<option value="">Selecione</option>
						@foreach($pessoaFisica as $pf)
						<option value="{{$pf->id_parte}}">{{$pf->nome}}</option>
						@endforeach
					</select>
					<input type="hidden" name="participacao[]" value="c">
				</div>
			</div> -->
		</div>
	</div>
</div>
<div class="col-lg-12 well">
	<div class="row">
		<div class="col-sm-12">
			<div class="row" id="adversa">
				<div class="col-sm-10 form-group">
					<label>Parte adversa<span class="asterisk">*</span></label>
					<select class="form-control single-select pessoa adversa" name="id_parte[]" data-validation="required">
						<option value="">Selecione</option>
						<optgroup label="Pessoa Física"> 
						@foreach($pessoaFisica as $pf)
						<option value="{{$pf->id_parte}}">{{$pf->nome}}</option>
						@endforeach
						</optgroup>
						<optgroup label="Pessoa Jurídica">  
						@foreach($pessoaJuridica as $pj)
						<option value="{{$pj->id_parte}}" id="{{$pj->razao_social}}">{{$pj->razao_social}}</option>
						@endforeach
						</optgroup>
					</select>
					<div class="d"></div>
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
	<button type="submit" class="btn btn-lg btn-info" id="submit">Cadastrar <i class="fa fa-plus" aria-hidden="true"></i></button>
</div>
<br>
<br>

</div> 


{!! Form::close() !!}
@endsection

@section('content_js')
<script type="text/javascript" >

	/*$(document).on('change', 'select.pessoa.cliente', function(event) {
       var idSelecionado = $(event.target).val();
       var jaSelecionado = false;
       selectsDeClientes.forEach(function(select) {
       	if ($(select).val() === idSelecionado) {
       		jaSelecionado = true;
       	}
       });

       if (jaSelecionado) {
       	// invalidar selecao do campo
       	console.log('Cliente ja selecionado', idSelecionado);
       }
	})  */

	$(document).on('change', '.pessoa', function(event) {
		var values = [];
		$('.pessoa').each(
			function() {
				if (values.indexOf(this.value) >= 0) {
					//$(this).css("border-color", "rgb(185, 74, 72)", "!important");
					$( this ).parent().addClass("has-error");
					$('#submit').prop("disabled",true);
				}
				else {
					//$(this).css("border-color", ""); 
					$( this ).parent().removeClass("has-error");
					$('#submit').prop("disabled",false);
					values.push(this.value);

				}
			});
	});
	
	$(document).on('change', '.cliente', function(event) {
		$('.cliente').each(
			function() {
				var selected = $("option:selected", this);
       /* var empresas = $(this).find('option:selected').attr("id");
       document.getElementById('empresa').innerHTML= empresas;*/
       // selected.parent()[0].label=="Pessoa Jurídica"?$(".respCliente").show(): $(".resp").hide(); 
       var e=1;
       if(selected.parent()[0].label=="Pessoa Jurídica")
       {
       	e++;
       	$('#respCliente').append('<div class="row" id="resp'+e+'"> <div class="col-sm-10 form-group"><label>Responsável</label><select class="form-control single-select" name="id_parte[]" data-validation="required"><option value="">Selecione</option><?php foreach ($pessoaJuridica as $pj){ ?><option value="{{$pj->id_parte}}">{{$pj->razao_social}}</option> <?php } foreach ($pessoaFisica as $pf){ ?><option value="{{$pf->id_parte}}">{{$pf->nome}}</option> <?php }?></select><input type="hidden" name="participacao[]" value="c"></div>');
       	$(".single-select").select2({placeholder: "Selecione ou Digite", allowClear: true, theme: "bootstrap"});
       }      
   });   

	});

$(document).ready(function() {
/*	 $(".pessoa").select2( {placeholder: "Selecione ou Digite", allowClear: true, theme: "bootstrap"});
*/ 

$(".respCliente").hide();


 var x=10;  
      $('#addCl').click(function(){  
           x++;  
           $('#cliente').after('<div class="row" id="cl'+x+'"> <div class="col-sm-10 form-group"><label>Cliente</label><select class="form-control single-select pessoa cliente" name="id_parte[]" data-validation="required"><option value="">Selecione</option><optgroup label="Pessoa Jurídica"> <?php foreach ($pessoaJuridica as $pj){ ?><option value="{{$pj->id_parte}}">{{$pj->razao_social}}</option> <?php }?></optgroup><optgroup label="Pessoa Física"> <?php foreach ($pessoaFisica as $pf){ ?><option value="{{$pf->id_parte}}">{{$pf->nome}}</option> <?php }?></optgroup></select><input type="hidden" name="participacao[]" value="c"></div> <div class="col-sm-2 form-group" style="padding-top: 27px; padding-left: 40px;"><a id="'+x+'" class="btn btn-danger btn_removeCl"><i class="fa fa-times" aria-hidden="true"></i></a></div></div>');  
           $(".single-select").select2({placeholder: "Selecione ou Digite", allowClear: true, theme: "bootstrap"});
      });  
      $(document).on('click', '.btn_removeCl', function(){  
           var button_id = $(this).attr("id");  
           $('#cl'+button_id+'').remove(); 
      });  


   var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#adversa').after('<div class="row" id="row'+i+'"> <div class="col-sm-10 form-group"><label>Parte adversa</label><select class="form-control single-select pessoa" name="id_parte[]" data-validation="required"><option value="">Selecione</option><?php foreach ($pessoaJuridica as $pj){ ?><option value="{{$pj->id_parte}}">{{$pj->razao_social}}</option> <?php } foreach ($pessoaFisica as $pf){ ?><option value="{{$pf->id_parte}}">{{$pf->nome}}</option> <?php }?></select><input type="hidden" name="participacao[]" value="a"></div> <div class="col-sm-2 form-group" style="padding-top: 27px; padding-left: 40px;"><a name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-times" aria-hidden="true"></i></a></div></div>');  
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