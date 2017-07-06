@extends('layouts.master')
@section('content')

<div class="container">

    <div id="login-form">
        <form method="POST" role="form" action="{{ url('/login') }}" >
            {{ csrf_field() }}

            <div class="col-md-12">

                <div class="form-group">
                    <h2 class="">Acesso ao Sistema</h2>
                </div>

                <div class="form-group">
                    <hr />
                </div>



                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input id="username" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" required autofocus>
                    </div>
                    <div>
                        @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                        @endif
                    </div>

                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input id="senha" type="password" class="form-control" name="password" placeholder="Senha" required>
                    </div>
                    <div>
                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>

                </div>

                <div class="form-group">
                    <hr />
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-sign" name="btn-login">Entrar</button>
                </div>

                <div class="form-group">
                    <hr />
                </div>
                <div class="form-group">
                    <a href="{{ url('/password/reset') }}">Esqueceu a senha?</a>
                </div>

            </div>

        </form>
    </div>  

</div>
@endsection