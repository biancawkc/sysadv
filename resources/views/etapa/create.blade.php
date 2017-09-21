@extends('layouts.master2')

@section('content')
@if($errors->any())
<ul class="alert alert-danger">
	@foreach($errors->all() as $error)
	<li>{{$error}}</li>
	@endforeach
</ul>
@endif
{!! Form::open(['route'=>['etapa.store', $idProcesso], 'method'=>'post', 'id'=>'colabForm']) !!}
@include('flash::message')
<div class="container-custom">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<h1 class="col-lg-12 well "> Cadastro de Etapa <i class="fa fa-calendar-plus-o fa-1x etapa" aria-hidden="true"></i>
	</h1>

	<div class="col-lg-12 well">
		<div class="row">
			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-4 form-group">
						<label>Data início<span class="asterisk">*</span></label>
						<div class="input-group add-on col-md-12" >
							<div class="input-group-btn">
								<a class="btn btn-default"><i class="fa fa-calendar"></i></a>
							</div>
							<input name="dt_etapa" type="text" class="form-control date etapaIni" data-validation="date" data-validation-format="dd/mm/yyyy" placeholder="dd/mm/aaaa" readonly>
						</div>
					</div>
					<div class="col-sm-4 form-group">
						<label>Data final<span class="asterisk">*</span></label>
						<div class="input-group add-on col-md-12" >
							<div class="input-group-btn">
								<a class="btn btn-default"><i class="fa fa-calendar"></i></a>
							</div>
							<input name="dt_prazo" type="text" class="form-control date etapaFn" data-validation="date" data-validation-format="dd/mm/yyyy" placeholder="dd/mm/aaaa" readonly>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label>Nome<span class="asterisk">*</span></label>
					<select class="form-control single-select" name="id_etapa" data-validation="required">
						<option value="">Selecione</option>
						@foreach($nmEtapas as $nmEtapa)
						<option value="{{$nmEtapa->id_etapa}}">{{$nmEtapa->nm_etapa}}</option>
						@endforeach						
					</select>
				</div>	

				<div class="form-group">
					<label>Descrição<span class="asterisk">*</span></label>
					<textarea class="form-control" rows="4" name="desc_etapa" data-validation="required"></textarea>
				</div>

			</div>
		</div>
	</div>
	<div class="form-group">
		<p><b><span class="asterisk">*</span>Campos de Preenchimento Obrigatórios </b><br><br></p>
	</div>

	<div class="text-center">
		<a href="{{ URL::to('/etapa/'.$idProcesso) }}" class="btn btn-lg btn-danger">Voltar <i class="fa fa-undo" aria-hidden="true"></i></a>
		&nbsp;&nbsp;&nbsp;
		<button type="submit" class="btn btn-lg btn-info">Cadastrar <i class="fa fa-plus" aria-hidden="true"></i></button>
	</div>
	<br>
	<br>
</div> 

{!! Form::close() !!}
@endsection

@section('content_js')
<script type="text/javascript">
	$(".single-select").select2({placeholder: "Selecione ou Digite", allowClear: true, theme: "bootstrap"});
</script>

@endsection