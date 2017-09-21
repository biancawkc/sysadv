@extends('layouts.master2')

@section('content')
@if($errors->any())
<ul class="alert alert-danger">
	@foreach($errors->all() as $error)
	<li>{{$error}}</li>
	@endforeach
</ul>
@endif
{!! Form::open(['route'=>['jurid.update', $pessoaJuridica->id_parte], 'method'=>'put', 'class'=>'form']) !!}
@include('flash::message')
<div class="container-custom">
	<input type="hidden" name="ativo" value="0">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<h1 class="col-lg-12 well "> Editar Pessoa Jurídica <i class="fa fa-user-plus user-plus" aria-hidden="true"></i>
	</h1>

	<div class="col-lg-12 well">
		<div class="row">
			<div class="col-sm-12">

				<div class="form-group">
					<label>Razão Social <span class="asterisk">*</span></label>
					<input type="text" placeholder="" name="razao_social" class="form-control" data-validation="required"  value="{{$pessoaJuridica->razao_social}}">
				</div>

				<div class="form-group">
					<label>Nome Fantasia</label>
					<input type="text" placeholder="" name="nm_fantasia" class="form-control" value="{{$pessoaJuridica->nm_fantasia}}">
				</div>


				<div class="row">
					<div class="col-sm-4 form-group">
						<label>CNPJ <span class="asterisk">*</span></label>						
						<input type='text' name="cnpj" class="form-control" data-validation="required" value="{{$pessoaJuridica->cnpj}}" readonly />
					</div>

					<div class="col-sm-8 form-group">
						<label>Incrição Estadual <span class="asterisk">*</span></label>
						<input type='text' name="ins_estadual" class="form-control" data-validation="required" value="{{$pessoaJuridica->ins_estadual}}" />
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
					<input type="text" placeholder="" name="email" class="form-control"  data-validation="required email" value="{{$parte->email}}">
				</div>
			</div>

				@foreach($telefone as $ind =>$tel)
				@if($ind == 0)
				<div class="row" id="dynamic_field">
				@else
				<div class="row"  id="row1{{$ind}}">
				@endif		
					<div class="col-sm-4 form-group">
						<label>Tipo de Telefone<span class="asterisk">*</span></label>
						<select class="form-control" name="id_tp_telefone[]" data-validation="required">
							<option value="{{$tel->id_tp_telefone}}" selected>{{$tel->tp_telefone}}</option>
							@foreach($tp_tel as $tels)
							@if( $tels->id_tp_telefone !== $tel->id_tp_telefone)
							<option value="{{$tels->id_tp_telefone}}">{{$tels->tp_telefone}}</option>
							@endif
							@endforeach
						</select>
					</div>	

					<div class="col-sm-4 form-group" >
						<label>Telefone<span class="asterisk">*</span></label>
						<input class="form-control phone_with_ddd" type="text" name="telefone[]" value="{{$tel->telefone}}">
					</div>
					@if($ind !== 0)
					<div class="col-sm-4 form-group" style="padding-top: 29px; padding-left: 35px;">
					<button type="button" name="remove" id="1{{$ind}}" class="btn btn-danger btn_remove"><i class="fa fa-times" aria-hidden="true"></i></button>
					</div>
					@else
					<div class="col-sm-4 form-group" style="padding-top: 29px; padding-left: 35px;">
						<a name="add" id="add" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i></a>
					</div>	
					@endif		
				</div>
				@endforeach

			</div>
		</div>
	</div>


	<div class="col-lg-12 well">
		<div class="row">
			<div class="col-sm-12">

				<div class="row">

					<div class="col-sm-3 form-group">
						<label>CEP <span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="cep" id="cep" class="form-control cep" data-validation="required cep" value="{{$endereco->cep}}" >
					</div>

					<div class="col-sm-7 form-group">
						<label>Logradouro <span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="logradouro" id="rua" class="form-control" value="{{$endereco->logradouro}}" data-validation="required" >
					</div>
						<div class="col-sm-2 form-group null">
						<label>Número</label>
						<input type="text" placeholder="" name="numero" class="form-control" value="{{$endereco->numero}}">
					</div>

				</div>

				<div class="row">

					<div class="col-sm-4 form-group">
						<label>Cidade <span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="cidade" id="cidade" class="form-control" data-validation="required" value="{{$endereco->cidade}}">
					</div>

					<div class="col-sm-2 form-group">
						<label>UF <span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="uf" id="uf" class="form-control" data-validation="required" value="{{$endereco->uf}}">
					</div>

					<div class="col-sm-4 form-group">
						<label>Bairro <span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="bairro" id="bairro" class="form-control" value="{{$endereco->bairro}}" data-validation="required" >
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
					

					<div class="col-sm-12 form-group">
						<label>Descrição de atividades</label>
						<textarea class="form-control" rows="3" name="desc_atividades">{{$pessoaJuridica->desc_atividades}}</textarea>
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
		<a href="{{ URL::to('/pessoaJuridica/' . $pessoaJuridica->id_parte . '/show') }}" class="btn btn-lg btn-danger">Voltar <i class="fa fa-undo" aria-hidden="true"></i></a>
		&nbsp;&nbsp;&nbsp;
		<button type="submit" class="btn btn-lg btn-info">Salvar <i class="fa fa-check" aria-hidden="true"></i></button>
	</div>
<br>
<br>

	
</div> 



</form> 
{!! Form::close() !!}
@endsection

@section('content_js')
<script type="text/javascript" >

	$(document).ready(function() {
$(".single-select").select2( {placeholder: "Selecione ou Digite", allowClear: true, theme: "bootstrap"});
   var i=1;  
   var maxField = 3;
      $('#add').click(function(){  
      	if(i < maxField){ 
           i++;  
           $('#dynamic_field').after('<div class="row" id="row'+i+'"><div class="col-sm-4 form-group"><label>Tipo de Telefone<span class="asterisk">*</span></label><select class="form-control" name="id_tp_telefone[]" data-validation="required"><option value="">Selecione</option><?php foreach ($tp_tel as $tels){ ?><option value="{{$tels->id_tp_telefone}}">{{$tels->tp_telefone}}</option> <?php } ?></select></div><div class="col-sm-4 form-group" ><label>Telefone<span class="asterisk">*</span></label><input class="form-control phone_with_ddd" type="text" name="telefone[]"></div><div class="col-sm-4 form-group" style="padding-top: 29px; padding-left: 35px;"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-times" aria-hidden="true"></i></button></div></div>'); 
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