<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>RW Advocacia</title>

    <link href="{{ asset('../vendor/twbs/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{asset('../vendor/datatables/datatables/media/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('../vendor/fortawesome/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('../resources/assets/css/style.css')}}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            ]); ?>
        </script>
    </head>
    <body>
        <div class="navbar navbar-fixed-top navbar-custom navbar-custom-height" role="navigation">
            <div class="navbar-inner">
                <div class="container">

                    <label class="brand" style="margin: 10; float: none;">
                       <img src="{{ asset ('../resources/assets/images/rw.png')}}" alt="RW Advocacia"
                       class="img-responsive" style="width: 80px; height: 80px;">
                   </label>

                   <div class="brand2" style="padding-top: 15px; padding-bottom: 15px; text-align: center;">
                    <div class="navbar-brand" style="text-align: center;">
                        <p style="color: black; font-size: 28px;" >ADVOCACIA</p>
                    </div>
                </div>
                @if ( !Auth::guard('web_usuario')->guest())
                <div class="navbar-header pull-right navbar-brand pull-right">
                    <br>
                    <br>
                    <label class="user-detail"><span class="glyphicon glyphicon-user "></span>&nbsp; {{ Auth::guard('web_usuario')->user()->username }}&nbsp;</label> &nbsp;
                    <a href="{{ url('/usuario_logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" class="user-detail"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sair</a>

                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
                @endif

            </div>
        </div>
    </div>  

    <br>
  
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
    <script src="{{asset('../vendor/eternicode/bootstrap-datepicker/js/locales/bootstrap-datepicker.pt-BR.js')}}"></script>
    <script src="{{asset('../resources/assets/js/inc.js')}}"></script>
    <script src="{{asset('../resources/assets/js/jQuery-Form-Validator/form-validator/jquery.form-validator.min.js')}}"></script>
    <script src="{{asset('../resources/assets/js/jquery.mask.js')}}"></script>
<!--     <script src="{{asset('../vendor/select2/select2/js/jquery.select2.js')}}"></script>
 -->
    @yield('content_js')

</body>
</html>