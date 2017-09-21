@extends('layouts.master')

@section('content')
	@if (session('status'))
	<div class="alert alert-success">
		{{ session('status') }}
	</div>
	@endif
	<form class="form" role="form" method="POST" action="{{ url('password/reset') }}">
	{{ csrf_field() }}
	<input type="hidden" name="token" value="{{ $token }}">
	<div class="container-custom">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<h1 class="col-lg-12 well "> Redefinir Senha <i class="fa fa-lock doc" aria-hidden="true"></i>
		</h1>

		<div class="col-lg-12 well">
			<div class="row">
				<div class="col-sm-12">

					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						<label>Email<span class="asterisk">*</span></label>
						<input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" data-validation="email" autofocus>
						@if ($errors->has('email'))
						<span class="help-block">
							<strong>{{ $errors->first('email') }}</strong>
						</span>
						@endif
					</div>

					<div class="row">
						<div class="col-sm-4 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
							<label>Senha<span class="asterisk">*</span></label>
							 <input id="password" type="password" class="form-control" name="password" data-validation="length" data-validation-length="min6">
							@if ($errors->has('password'))
							<span class="help-block">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
							@endif			
						</div>

						<div class="col-sm-4 form-group">
							<label>Confirmar Senha<span class="asterisk">*</span></label>
							<input id="password-confirm" type="password" class="form-control" name="password_confirmation" data-validation="confirmation" data-validation-confirm="password">
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
	<button type="submit" class="btn btn-lg btn-info">Cadastrar <i class="fa fa-plus" aria-hidden="true"></i></button>
</div>


<br>
<br>
</div> 

</form>
@endsection

@section('content_js')
<script type="text/javascript">
	$.validate({
		lang: 'pt',
 		modules : 'security'
 	});
</script>
@endsection
