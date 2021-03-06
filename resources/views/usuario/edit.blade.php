@extends('layouts.master2')

@section('content')

{!! Form::open(['route'=>['usuario.update', $usuario->id_usuario], 'method'=>'put']) !!}
	<input type="hidden" name="ativo" value="1">
	<input type="hidden" name="administrador" value="0">
	<div class="container-custom">
		@if ($errors->any())
		<ul class="alert alert-danger error-alert">
			@foreach($errors->all() as $error)
			<li>{{$error}}</li>
			@endforeach
		</ul>
		@endif
		@include('flash::message')
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<h1 class="col-lg-12 well "> Editar Usuário <i class="fa fa-user user-plus" aria-hidden="true"></i>
			<span class="questionMark pull-right"><i class="fa fa-question-circle help" aria-hidden="true"></i></span>
		</h1>

		<div class="col-lg-12 well">
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group">
						<label>Nome <span class="asterisk">*</span></label>
						<input type="text"  value="{{$usuario->nome}}" class="form-control" readonly data-validation="required">
					</div>	
				
					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						<label>Email<span class="asterisk">*</span></label>
						<input type='text' name="email" class="form-control" value="{{$usuario->email}}" data-validation="email" readonly />
						<!-- @if ($errors->has('email'))
						<span class="help-block">
							<strong>{{ $errors->first('email') }}</strong>
						</span>
						@endif -->
					</div>

					<div class="row">
						<div class="col-sm-4 form-group{{ $errors->has('username') ? ' has-error' : '' }}">
							<label>Usuário<span class="asterisk">*</span></label>				
							<input type='text' name="username" class="form-control" value="{{$usuario->username}}" data-validation="required" readonly />
							<!-- @if ($errors->has('username'))
							<span class="help-block">
								<strong>{{ $errors->first('username') }}</strong>
							</span>
							@endif -->
						</div>
						<div class="col-sm-4 form-group{{ $errors->has('username') ? ' has-error' : '' }}">
							<label>Nível de acesso<span class="asterisk">*</span></label>				
							<select class="form-control" name="administrador" id="administrador" data-validation="required">
								<option value="">Selecione</option>
								<option value="1">Administrador</option>
								<option value="0">Usuário Comum</option>
							</select>
						</div>
						<div class="col-sm-4 form-group{{ $errors->has('username') ? ' has-error' : '' }}">
							<label>Situação<span class="asterisk">*</span></label>				
							<select class="form-control" name="ativo" id="ativo" data-validation="required">
								<option value="">Selecione</option>
								<option value="1">Ativo</option>
								<option value="0">Inativo</option>
							</select>
						</div>
						
					</div>

				</div>
			</div>
		</div>

		<div class="form-group">
			<p><b><span class="asterisk">*</span>Campos de Preenchimento Obrigatórios </b><br><br></p>
		</div>
		<div class="text-center">
	<a href="{{ URL::to('/usuario') }}" class="btn btn-lg btn-danger">Voltar <i class="fa fa-undo" aria-hidden="true"></i></a>
	&nbsp;&nbsp;&nbsp;
	<button type="submit" class="btn btn-lg btn-info">Salvar <i class="fa fa-check" aria-hidden="true"></i></button>
</div>

<br>
<br>
<div class="modal fade helps" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h3 class="modal-title"><i class="fa fa-info-circle info" aria-hidden="true"></i> Informação</h3>
								</div>
								<div class="modal-body">
									<p>
										<b>Nível de acesso</b>: Usuário comum; tem acesso limitado de funções. Adminsitrador; tem acesso completo de todas as funções.<br><br>
										<b>Situação</b>: Ativo; um usuário com situação ativa possui acesso à aplicação. Inativo; um usuário com situação inativa não possui mais acesso à aplicação.<br><br>
									</p>
								</div>
							</div>  
						</div>
					</div>
				
				</div> 
</div> 

{!! Form::close() !!}
@endsection
@section('content_js')
<script type="text/javascript">
	$admin = {{$usuario->administrador}}
	$("#administrador").val($admin);

	$ativo = {{$usuario->ativo}}
	$("#ativo").val($ativo);

</script>
@endsection
