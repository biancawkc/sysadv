<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset ('../resources/assets/images/rw.png')}}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>RW Advocacia</title>

    <link href="{{ asset('../vendor/twbs/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{asset('../vendor/datatables/datatables/media/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('../vendor/fortawesome/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('../resources/assets/css/style.css')}}" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css"> -->
   <!--  <link rel="stylesheet" type="text/css" href="{{asset('../vendor/bootstrap-select/bootstrap-select/dist/css/bootstrap-select.min.css')}}"> -->
    <link href="{{asset('../vendor/bootstrap-fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('../vendor/select2/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('../resources/assets/select2/dist/select2-bootstrap.min.css')}}">
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            ]); ?>
        </script>

        <style type="text/css">
            
         .navbar .navbar-nav > li > a {
            color:#1a1a1a;
            font-size: 15px;
        }

 .navbar-default {
    background-color: #6DBDD6;
}

.navbar-default a:hover {
    color: transparent;
}
.navbar-default .nav > li > a:hover {
    background-color: transparent;
}
.navbar .navbar-nav > li.open > a {
    background-color: transparent;
}
.navbar .navbar-nav > li.open > a:hover,
.navbar .navbar-nav > li.open > a:focus {
    background-color: transparent;
}
  </style>
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
        </button>
        <img src="{{ asset ('../resources/assets/images/rw.png')}}" alt="RW Advocacia"
        class="img-responsive" style="width: 47px; height: 47px;">
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
          <li><a href="{{ URL::to('home') }}">Home</a></li>
            <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Pessoa
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ URL::to('pessoa/verify') }}">Cadastrar</a></li>
                    <li> <a href="{{ URL::to('pessoa') }}">Listagem</a></li>
                </ul>
            </li>
              <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Processo
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ URL::to('processo/verify') }}">Cadastrar</a></li>
                    <li> <a href="{{ URL::to('processo') }}">Listagem</a></li>
                </ul>
            </li>
            @if (Auth::guard('web_usuario')->user()->administrador)
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Colaboradores
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ URL::to('colaborador/verify') }}">Cadastrar</a></li>
                    <li> <a href="{{ URL::to('funcionario') }}">Funcionários</a></li>
                    <li><a href="{{ URL::to('advogado') }}">Advogados</a></li>
                </ul>
            </li>
            
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Usuários
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ URL::to('/cadastrar_usuario') }}">Cadastrar</a></li>
                    <li> <a href="{{ URL::to('usuario') }}">Listagem</a></li>
                </ul>
            </li>
            @endif
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a><span class="glyphicon glyphicon-user"></span> {{ Auth::guard('web_usuario')->user()->username }}</a></li>
          <li><a href="{{ url('/usuario_logout') }}"
             onclick="event.preventDefault();
             document.getElementById('logout-form').submit();" class="user-detail"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sair</a>
             <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li> 
    </ul>
</div>
</div>
</nav>



<div  style="height:auto; margin: 0 auto -60px; padding: 0 0 60px">

    @yield('content')
</div>
<br>
<br>
<footer class="container-fluid text-center navbar-fixed-bottom pull-down ">
    <p>Copyright &copy; <?php echo date("Y");?></p>
</footer>



<!-- Scripts -->
<script src="/js/app.js"></script>
<script src="{{ asset('../vendor/components/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('../vendor/twbs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{asset('../vendor/components/jquery/jquery-migrate.min.js')}}"></script>
<script src="{{asset('../vendor/datatables/datatables/media/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('../resources/assets/Portuguese.json')}}"></script>
<script src="{{asset('../vendor/eternicode/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('../vendor/bootstrap-select/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('../vendor/eternicode/bootstrap-datepicker/js/locales/bootstrap-datepicker.pt-BR.js')}}"></script>
<script src="{{asset('../resources/assets/js/jQuery-Form-Validator/form-validator/jquery.form-validator.min.js')}}"></script>
<script src="{{asset('../resources/assets/js/jquery.mask.js')}}"></script>
<script src="{{asset('../vendor/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js')}}"></script>
<script src="{{asset('../vendor/bootstrap-fileinput/js/plugins/sortable.min.js')}}"></script>
<script src="{{asset('../vendor/bootstrap-fileinput/js/plugins/purify.min.js')}}"></script>
<script src="{{asset('../vendor/bootstrap-fileinput/js/fileinput.min.js')}}"></script>
<script src="{{asset('../vendor/bootstrap-fileinput/themes/fa/theme.js')}}"></script>
<script src="{{asset('../vendor/bootstrap-fileinput/js/locales/pt-BR.js')}}"></script>
<script src="{{asset('../vendor/select2/select2/dist/js/select2.js')}}"></script>
<script src="{{asset('../resources/assets/js/inc.js')}}"></script>
@yield('content_js')
</body>
</html>