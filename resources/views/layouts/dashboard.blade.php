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
	<style>
		/* Set height of the grid so .sidenav can be 100% (adjust as needed) */
		.row.content {height: 550px}

		/* Set gray background color and 100% height */
		.sidenav {
			background-color: #FFE658;
			height: 100%;
		}

		/* On small screens, set height to 'auto' for the grid */
		@media screen and (max-width: 767px) {
			.row.content {height: auto;} 
		}

		.adv {
			position: absolute;
			left: 13%;
			margin-left: -100px !important;  /* 50% of your logo width */
			display: block;
			margin-top: -45px;
			font-family: "Times New Roman";
			font-size: 17px;
		}
		.navbar-default1 {
			background-color: #6DBDD6;
			border-color: #6DBDD6;
		}
		/* Title */
		.navbar-default .navbar-brand {
			color: #6DBDD6;
		}

		.panel-black {
			border-color: #404040;
		}
		.panel-black > .panel-heading {
			border-color: #404040;
			color: white;
			background-color: #404040;
		}
		.panel-black > a {
			color: #404040;
		}
		.panel-black > a:hover {
			color: #404040;
		}
		.panel-red {
			border-color: #B71427;
		}

		.panel-red > .panel-heading {
			border-color: #B71427;
			color: white;
			background-color: #B71427;
		}
		.panel-red > a {
			color: #B71427;
		}
		.panel-red > a:hover {
			color: #B71427;
		}

		.panel-yellow {
			border-color: #6DBDD6;
		}

		.panel-yellow > .panel-heading {
			border-color: #6DBDD6;
			color: white;
			background-color: #6DBDD6;
		}
		.panel-yellow > a {
			color: #6DBDD6;
		}
		.panel-yellow > a:hover {
			color: #6DBDD6;
		}

		.huge {
			font-size: 40px;
		}

	</style>
</head>
<body>
	<nav class="navbar navbar-default1 navbar-static-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>                        
				</button>
				<label style="margin: 1; float: none; margin-top: 5px;">
					<img src="{{ asset ('../resources/assets/images/rw_adv.png')}}" alt="RW Advocacia"
					class="img-responsive" style="width: 157px; height: 48px;">
				</label>
				<!-- <label class="adv">ADVOCACIA</label> -->

			</div>
			@if ( !Auth::guard('web_usuario')->guest())
			
			<div class="navbar-header pull-right navbar-brand pull-right">
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
	</nav>
<div class="col-lg-12">
	<div class="container-fluid">
		<div class="row content">
			<div class="col-sm-4 sidenav panel panel-default">
				<div class="panel-body">
					<div class="panel-heading">
						<h4><i class="fa fa-bell fa-fw fa-2x"></i> Datas Importantes</h4>
					</div>
					<div class="list-group">
					@if(!$datas->isEmpty())
					@foreach($datas as $key => $value)
						<a target="_blank" href="{{URL::to('etapa/'.$value->id_etapa_processo.'/show')}}" class="list-group-item">
							@if(strlen($value->nm_etapa) > 25)
							<i class="fa fa-calendar-times-o fa-fw" data-toggle="tooltip" data-placement="top" title="Deletar"s></i> {{substr($value->nm_etapa, 0, 25)}}...
							@else
							<i class="fa fa-calendar-times-o fa-fw"></i> {{$value->nm_etapa}}
							@endif
							 <span class="pull-right text-muted small"><em>{{date('d/m/Y', strtotime($value->dt_prazo))}}</em>
						</a>
					@endforeach
					@else
					<label class="list-group-item">
							<i class="fa fa-calendar-times-o fa-fw"></i> Não possui datas cadastradas  
							 <span class="pull-right text-muted small"><em></em>
					</label>
					@endif
					</div>

					@if($num > 9)
					<br>
					<a href="{{URL::to('/agenda')}}" class="btn btn-default btn-block">Mais</a>
					@endif
				</div>
			</div>
			<br>

			<div class="col-sm-8 ">
				<div class="well text-center">
					<h1>Painel de Controle <i class="fa fa-desktop" aria-hidden="true"></i></h1>
				</div>
				<div class="col-lg-12 well">
				<div class="row">
				<div class="col-lg-4 col-md-6">
						<div class="panel panel-black">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-tasks fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<h4>Processos</h4>
									</div>
								</div>
							</div>
							<a href="{{ URL::to('/processo') }}">
								<div class="panel-footer">
									<span class="pull-left">Entrar</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="panel panel-black">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-address-card fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<h4>Partes</h4>
									</div>
								</div>
							</div>
							<a href="{{ URL::to('/pessoa') }}">
								<div class="panel-footer">
									<span class="pull-left">Entrar</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
				@if (Auth::guard('web_usuario')->user()->administrador)
					<div class="col-lg-4 col-md-6">
						<div class="panel panel-black">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-user-circle-o fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<h4>Colaboradores</h4>
									</div>
								</div>
							</div>
							<a href="{{ URL::to('/colaboradores') }}">
								<div class="panel-footer">
									<span class="pull-left">Entrar</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>						
				</div>
				 <div class="row">
		
			<!-- 		<div class="col-lg-3 col-md-6">
						<div class="panel panel-red">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-money fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge">12</div>
										<div>Pagamentos</div>
									</div>
								</div>
							</div>
							<a href="#">
								<div class="panel-footer">
									<span class="pull-left">Entrar</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div> -->

					<div class="col-lg-4 col-md-6">
						<div class="panel panel-black">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-users fa-5x"></i>
									</div>
									<div class="col-xs-9 text-right">
										
										<h4>Usuários</h4>
									</div>
								</div>
							</div>
							<a href="{{ URL::to('/usuario') }}">
								<div class="panel-footer">
									<span class="pull-left">Entrar</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div>
					</div>
					@endif
			<!-- 		<div class="col-sm-4">
						<div class="well">
							<p>Text</p> 
							<p>Text</p> 
							<p>Text</p> 
						</div>
					</div>
					<div class="col-sm-4">
						<div class="well">
							<p>Text</p> 
							<p>Text</p> 
							<p>Text</p> 
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-8">
						<div class="well">
							<p>Text</p> 
						</div>
					</div>
					<div class="col-sm-4">
						<div class="well">
							<p>Text</p> 
						</div>
					</div>
				</div> -->
			</div> 
		</div>
	</div>
	</div>

	<!-- Scripts -->
	<script src="/js/app.js"></script>
	<script src="{{ asset('../vendor/components/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('../vendor/twbs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	<script src="{{asset('../resources/assets/js/inc.js')}}"></script>


</body>
</html>