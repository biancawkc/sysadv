@extends('layouts.master')

@section('content')
@if($errors->any())
<ul class="alert alert-danger">
	@foreach($errors->all() as $error)
	<li>{{$error}}</li>
	@endforeach
</ul>
@endif
 <form role="form" method="POST" action="{{ url('/cadastrar_usuario') }}">
@include('flash::message')
<div class="container-custom">
	<input type="hidden" name="ativo" value="0">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<h1 class="col-lg-12 well "> Cadastro de Usuário <i class="fa fa-user-plus user-plus" aria-hidden="true"></i>
	</h1>

	<div class="col-lg-12 well">
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<label>Nome <span class="asterisk">*</span></label>
					<select class="form-control selectpicker" data-live-search="true">
						<option>Selecione</option>
						@foreach($people as $people)
						<option value="{{$people->id_parte}}">{{$people->nome}}</option>
						@endforeach
					</select>
				</div>	

				<div class="row">

					<div class="col-sm-4 form-group">
						<label>Username<span class="asterisk">*</span></label>
						
						<input type='text' name="username" class="form-control" />

					</div>

					<div class="col-sm-8 form-group">
						<label>Email<span class="asterisk">*</span></label>
						
						<input type='text' name="email" class="form-control" />

					</div>
				</div>

				<div class="row">

					<div class="col-sm-4 form-group">
						<label>Senha<span class="asterisk">*</span></label>
						<input type='text' name="email" class="form-control" />
						
					</div>

					<div class="col-sm-4 form-group">
						<label>Confirmar Senha<span class="asterisk">*</span></label>
						<input type="text" placeholder="" name="rg" class="form-control rg" value="" data-validation="required" >
					</div>

				</div>

			</div>
		</div>
	</div>

	<div class="form-group">
		<p><b><span class="asterisk">*</span>Campos de Preenchimento Obrigatórios </b><br><br></p>
	</div>
<div class="text-center">
	<!-- <a href="{{ URL::to('/verify') }}" class="btn btn-lg btn-danger">Voltar <i class="fa fa-undo" aria-hidden="true"></i></a>
	&nbsp;&nbsp;&nbsp; -->
	<button type="submit" class="btn btn-block btn-info">Cadastrar <i class="fa fa-plus" aria-hidden="true"></i></button>
</div>

	
	<br>
	<br>
</div> 


</form>
@endsection

