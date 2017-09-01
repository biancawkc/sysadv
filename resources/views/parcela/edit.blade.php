@extends('layouts.master2')

@section('content')
@if($errors->any())
<ul class="alert alert-danger">
	@foreach($errors->all() as $error)
	<li>{{$error}}</li>
	@endforeach
</ul>
@endif
{!! Form::open(['route'=>['parcela.update', $parcela->id_parcela], 'method'=>'put', 'class'=>'form']) !!}
@include('flash::message')
<div class="container-custom">
	<input type="hidden" name="id_tp_parcela" value="1">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	@if(is_null($parcela->porcentagem))
	<h1 class="col-lg-11 well "> Atualizar Parcela Honorários <i class="fa fa-usd dollar" aria-hidden="true"></i>
	@else
	<h1 class="col-lg-11 well "> Atualizar Parcela Ganho de Causa <i class="fa fa-usd dollar" aria-hidden="true"></i>
	@endif
	</h1>


	<div class="col-lg-11 well">
		<div class="row">
			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-3 form-group">
						<label>Valor parcela<span class="asterisk">*</span></label>
						<input type='number' name="valor" class="form-control currency" data-validation="required" value="{{$parcela->valor}}" />
					</div>

					<div class="col-sm-2 form-group">
						<label>Nº<span class="asterisk">*</span></label>				
						<input type='number' name="num_parcela" value="1" class="form-control" data-validation="required" readonly/>
					</div>

					<div class="col-sm-5 form-group">
						<label>Forma de pagamento<span class="asterisk">*</span></label>
						<select class="form-control" name="id_forma_pag" id="formaPag">
							<option>Selecione</option>
							@foreach($formaPag as $formaPags)
							<option value="{{$formaPags->id_forma_pag}}">{{$formaPags->forma_pag}}</option>
							@endforeach						
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-5 form-group">
						<label>Data de vencimento<span class="asterisk">*</span></label>
						<div class="input-group add-on col-md-12">
							<div class="input-group-btn">
								<a class="btn btn-default"><i class="fa fa-calendar"></i></a>
							</div>
							<input name="dt_venc" type="text" class="form-control date-picker datepicker date" data-date-format="dd/mm/yyyy" data-validation="date" data-validation-format="dd/mm/yyyy" placeholder="dd/mm/aaaa" value="{{date('d/m/Y', strtotime($parcela->dt_venc))}}">		
						</div>
					</div>
					<div class="col-sm-5 form-group null">
						<label>Data de pagamento</label>
						<div class="input-group add-on col-md-12">
							<div class="input-group-btn">
								<a class="btn btn-default"><i class="fa fa-calendar"></i></a>
							</div>
							<input name="dt_pag" type="text" class="form-control date-picker datepicker date" data-date-format="dd/mm/yyyy" data-validation="date" data-validation-format="dd/mm/yyyy" placeholder="dd/mm/aaaa" value="{{$pag}}" data-validation-optional="true" id="enterDate">
							</div>
					</div>
					<div class="col-sm-3 form-group">
						<input id="todayBox" type="checkbox">  &nbsp;Pago Hoje
					</div>
				</div>
				
			</div>
		</div>
	</div>
	
	<div class="form-group">
		<p><b><span class="asterisk">*</span>Campos de Preenchimento Obrigatórios </b><br><br></p>
	</div>

	<div class="text-center">
		<a href="{{ URL::to('/parcela/'.$parcela->id_processo) }}" class="btn btn-lg btn-danger">Voltar <i class="fa fa-undo" aria-hidden="true"></i></a>
		&nbsp;&nbsp;&nbsp;
		<button type="submit" class="btn btn-lg btn-info">Salvar <i class="fa fa-check" aria-hidden="true"></i></button>&nbsp;&nbsp;&nbsp;
		@if(!empty($parcela->dt_pag))
		<a href="{{ URL::to('/parcela/' .$parcela->id_parcela. '/recibo') }}" class="btn btn-lg btn-success">Recibo</a>
		@endif
	</div>
	<br>
	<br>
</div> 

</form> 
{!! Form::close() !!}
@endsection

@section('content_js')
<script type="text/javascript" >

$pag = {{$parcela->id_forma_pag}}
	$("#formaPag").val($pag);

$("#todayBox").change(function() {
    var dateStr;
    if (this.checked) {
        var now = new Date();
        dateStr = now.getDate() + "/" + (now.getMonth() + 1) + "/" + now.getFullYear();
    } else {
        dateStr = "";
    }
    $("#enterDate").val(dateStr);
})

</script>

@endsection