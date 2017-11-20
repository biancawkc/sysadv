@extends('layouts.master2')

@section('content')
{!! Form::open(['route'=>['despesa.update', $despesa->id_despesa], 'method'=>'put']) !!}
<div class="container-custom">
	@if($errors->any())
	<ul class="alert alert-danger">
		@foreach($errors->all() as $error)
		<li>{{$error}}</li>
		@endforeach
	</ul>
	@endif
	@include('flash::message')
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<h1 class="col-lg-12 well "> Editar Despesa <i class="fa fa-shopping-basket despesa" aria-hidden="true"></i>
	</h1>

	<div class="col-lg-12 well">
		<div class="row">
			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-3 form-group">
						<label>Valor (R$)<span class="asterisk">*</span></label>
						<input name="" type="text right" class="form-control money real text-right" value="{{$valores}}">
						<input type="hidden" name="valor" class="valorV" value="{{$valores}}"> 		
					</div>
					<div class="col-sm-5 form-group">
						<label>Data<span class="asterisk">*</span></label>
						<div class="input-group add-on col-md-12" >
							<div class="input-group-btn">
								<a class="btn btn-default"><i class="fa fa-calendar"></i></a>
							</div>
							<input name="dt_despesa" type="text" class="form-control datepicker date" data-date-format="dd/mm/yyyy" data-validation="date" data-validation-format="dd/mm/yyyy" placeholder="dd/mm/aaaa" value="{{date('d/m/Y', strtotime($despesa->dt_despesa))}}">
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label>Descrição<span class="asterisk">*</span></label>
					<textarea class="form-control" rows="4" name="desc_despesa"  rows="4">{{$despesa->desc_despesa}}</textarea>
				</div>

			</div>
		</div>
	</div>
	<p>Data de criação: {{date('d/m/Y H:i:s', strtotime($despesa->dt_criacao))}} &nbsp;&nbsp;&nbsp; Última alteração feita em {{date('d/m/Y H:i:s', strtotime($despesa->dt_atualizacao))}} por {{$usuario->username}} </p>
	<div class="form-group">
		<p><b><span class="asterisk">*</span>Campos de Preenchimento Obrigatórios </b><br><br></p>
	</div>

	<div class="text-center">
		<a href="{{ URL::to('/despesa/' .$despesa->id_processo) }}" class="btn btn-lg btn-danger">Voltar <i class="fa fa-undo" aria-hidden="true"></i></a>
		&nbsp;&nbsp;&nbsp;
		<button type="submit" class="btn btn-lg btn-info">Salvar <i class="fa fa-plus" aria-hidden="true"></i></button>
	</div>
	<br>
	<br>
</div> 

{!! Form::close() !!}
@endsection

@section('content_js')
<script src="{{asset('../resources/assets/js/actions/parte.js')}}" type="text/javascript"></script>
@endsection