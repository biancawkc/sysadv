@extends('layouts.master')

<!-- Main Content -->
@section('content')

<div id="login-form">
      <form role="form" method="POST" action="{{ url('/password/email') }}">
        {{ csrf_field() }}

        <div class="col-md-12">

          @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        <div class="form-group">
            <h2 class="">Redefinição de Senha</h2>
        </div>

        <div class="form-group">
            <hr />
        </div>



                          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                       <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Email Cadastrado" autofocus>
                    </div>
                    <div>
                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>

                </div>

                <div class="form-group">
                    <hr />
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-sign" name="btn-login">Enviar Link</button>
                </div>
                <div class="form-group">
                    <hr />
                </div>
                <div class="form-group">
                    <a href="{{ url('/') }}">Voltar</a>
                </div>

  

    </div>

</form>
</div> 

@endsection