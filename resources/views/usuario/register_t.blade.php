@extends('layouts.master2')

@section('content')
<form role="form" method="POST" action="{{ url('/cadastrar_usuario') }}">
	@include('flash::message')
	<input type="hidden" name="ativo" value="1">
	<input type="hidden" name="administrador" value="0">
	<div class="container-custom">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<h1 class="col-lg-12 well "> Cadastro de Usuário <i class="fa fa-user-plus user-plus" aria-hidden="true"></i>
		</h1>

		<div class="col-lg-12 well">
			<div class="row">
				<div class="col-sm-12">
				@if($pessoaFisica !== "")
					<div class="form-group">
						<label>Nome <span class="asterisk">*</span></label>
						<input type="text"  value="{{$pessoaFisica->nome}}" class="form-control" readonly>
						<input type="hidden" name="id_parte" value="{{$pessoaFisica->id_parte}}">
					</div>	
				@else
				<div class="form-group">
						<label>Nome <span class="asterisk">*</span></label>
						<select class="form-control single-select" name="id_parte" data-validation="required">
							<option value=""></option>
							@foreach($advogado as $adv)
							<option value="{{$adv->id_parte}}">{{$adv->nome}}</option>
							@endforeach
							@foreach($funcionario as $func)
							<option value="{{$func->id_parte}}">{{$func->nome}}</option>
							@endforeach
						</select>
					</div>
				@endif

					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						<label>Email<span class="asterisk">*</span></label>
						<input type='text' name="email" class="form-control" value="{{ old('email') }}" required />
						@if ($errors->has('email'))
						<span class="help-block">
							<strong>{{ $errors->first('email') }}</strong>
						</span>
						@endif
					</div>

					<div class="row">
						<div class="col-sm-4 form-group{{ $errors->has('username') ? ' has-error' : '' }}">
							<label>Username<span class="asterisk">*</span></label>				
							<input type='text' name="username" class="form-control" value="{{ old('username') }}" required/>
							@if ($errors->has('username'))
							<span class="help-block">
								<strong>{{ $errors->first('username') }}</strong>
							</span>
							@endif
						</div>

						<div class="col-sm-4 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
							<label>Senha<span class="asterisk">*</span></label>
							<input type='password' name="password" class="form-control" id="password" required/>
							@if ($errors->has('password'))
							<span class="help-block">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
							@endif			
						</div>

						<div class="col-sm-4 form-group">
							<label>Confirmar Senha<span class="asterisk">*</span></label>
							<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
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
@if(!is_null($busca))
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title red">ATENÇÃO</h4>
        </div>
        <div class="modal-body">
          <p><b>{{$pessoaFisica->nome}}</b> já foi cadastrado como usuário!</p>
        </div>
        <div class="modal-footer">
          <a href="{{ URL::to('/cadastrar_usuario') }}" class="btn btn-info">Voltar</a>
          <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button> -->
        </div>
      </div>
    </div>
  </div>
 @endif
@endsection
@section('content_js')
@if(!is_null($busca))
    <script type="text/javascript">
        $(document).ready(function(){
            $('#myModal').modal({backdrop: 'static', keyboard: false});
        });
    </script>
 @endif
 <script type="text/javascript">
 	$(document).ready(function() {
  $(".single-select").select2( {placeholder: "Selecione ou Digite", allowClear: true, theme: "bootstrap"});
});
 </script>
@endsection

