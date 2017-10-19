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
@if(is_null($parcela->porcentagem))
<input type="hidden" name="id_tp_parcela" value="1">
@else
<input type="hidden" name="id_tp_parcela" value="2">
@endif
<div class="container-custom">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	@if(is_null($parcela->porcentagem))
	<h1 class="col-lg-12 well "> Atualizar Parcela Honorários <i class="fa fa-usd dollar" aria-hidden="true"></i>
		@else
		<h1 class="col-lg-12 well "> Atualizar Parcela Ganho de Causa <i class="fa fa-usd dollar" aria-hidden="true"></i>
			@endif
		</h1>


		<div class="col-lg-12 well">
			<div class="row">
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-3 form-group">
							<label>Valor (R$)<span class="asterisk">*</span></label>
							<input type='text' name="valor" class="form-control" data-validation="required" value="{{ $valores}}" readonly  id="valor" onkeyup="GetDays()" />
						</div>

						<div class="col-sm-2 form-group">
							<label>Nº<span class="asterisk">*</span></label>				
							<input type='number' name="num_parcela" value="{{$parcela->num_parcela}}" class="form-control" data-validation="required" readonly/>
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
						<div class="col-sm-4 form-group">
							<label>Data de vencimento<span class="asterisk">*</span></label>
							<div class="input-group add-on col-md-12">
								<div class="input-group-btn">
									<a class="btn btn-default"><i class="fa fa-calendar"></i></a>
								</div>
								<input name="dt_venc" type="text" class="form-control date-picker" data-date-format="dd/mm/yyyy" data-validation="date" data-validation-format="dd/mm/yyyy" placeholder="dd/mm/aaaa" value="{{date('d/m/Y', strtotime($parcela->dt_venc))}}" readonly id="dtVenc" onchange="GetDays()">		
							</div>
						</div>
						<div class="col-sm-4 form-group null">
							<label>Data de pagamento</label>
							<div class="input-group add-on col-md-12">
								<div class="input-group-btn">
									<a class="btn btn-default"><i class="fa fa-calendar"></i></a>
								</div>
								<input name="dt_pag" type="text" class="form-control dtPag" data-validation="date" data-validation-format="dd/mm/yyyy" placeholder="dd/mm/aaaa" value="{{$pag}}" data-validation-optional="true" id="dtPag" onchange="GetDays()" readonly>
							</div>
						</div>	
						<div class="col-sm-4 form-group null">
							<label>Responsabilidade</label><br>
							<label class="checkbox-inline"><input type="checkbox" name="optradio" value="1">Parte Adversa</label>
						</div>		
					</div>

					<div class="row">
						<div class="col-sm-3 form-group">
							<label>Juros/dia (%)<span class="asterisk">*</span></label>				
							<input type='text' name="juros" class="form-control" data-validation="required number" value="{{$parcela->juros}}" readonly id="juros" onkeyup="GetDays()"/>
						</div>

						<div class="col-sm-2 form-group null">
							<label>Dias atraso</label>				
							<input type='text' name="dias_atraso" class="form-control" readonly id="atraso" value="{{$parcela->dias_atraso}}" />
						</div>

						<div class="col-sm-2 form-group null">
							<label>Multa (R$)</label>				
							<input type='text' name="multa" class="form-control" readonly id="multa" value="{{$parcela->multa}}" />
						</div>

						<div class="col-sm-3 form-group null">
							<label>Desconto (R$)</label>				
							<input type='text' name="desconto" class="form-control" data-validation="number" data-validation-allowing="float" data-validation-optional="true" value="{{$parcela->desconto}}" id="desconto" onkeyup="this.value = this.value.replace(/,/g, '.'); GetDays();"/>
						</div>
					</div>
				</div>
			</div>
		</div>
	
			<h4 class="col-lg-12 well" style="display: none;" id="show">Valor Atualizado: R$ <b><span id="atualizado"></span></b></h4> 

			@if(!is_null($parcela->desconto) || !is_null($parcela->multa))
			<h4 class="col-lg-12 well" id="atual">Valor Atualizado: R$ <b>{{$valorF}}</b></h4>
			@endif
		

		<div class="form-group">
			<p><b><span class="asterisk">*</span>Campos de Preenchimento Obrigatórios </b><br><br></p>
		</div>

		<div class="text-center">
			<a href="{{ URL::to('/parcela/'.$parcela->id_processo) }}" class="btn btn-lg btn-danger">Voltar <i class="fa fa-undo" aria-hidden="true"></i></a>
			&nbsp;&nbsp;&nbsp;
			<button type="submit" class="btn btn-lg btn-info">Salvar <i class="fa fa-check" aria-hidden="true"></i></button>&nbsp;&nbsp;&nbsp;
			@if(!empty($parcela->dt_pag))
			<a target="_blank" href="{{ URL::to('/parcela/' .$parcela->id_parcela. '/recibo') }}" class="btn btn-lg btn-success">Recibo  <i class="fa fa-sticky-note-o" aria-hidden="true"></i></a>
			@else
			<button class="btn btn-lg btn-success" disabled>Recibo <i class="fa fa-sticky-note-o" aria-hidden="true"></i></button>
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

	function GetDays(){
		var dtPag = document.getElementById("dtPag").value;
		var dtVenc = document.getElementById("dtVenc").value;
		var total = document.getElementById("valor").value;
		var juros = document.getElementById("juros").value;
		var desconto = document.getElementById("desconto").value;
		var mdy = dtPag.split("/");
		var dtPagr = new Date(mdy[1] + "/" + mdy[0] + "/" + mdy[2]);
		var mmd = dtVenc.split("/");
		var dtVencr = new Date(mmd[1] + "/" + mmd[0] + "/" + mmd[2]);

		var dif = parseInt((dtPagr - dtVencr) / (24 * 3600 * 1000));

		var mult =parseFloat((juros/100)*dif);

		var multa = Math.round(mult *100)/100;

		if(desconto == "")
		{
			var dc = 0;
		} 
		else 
		{
			var dc = desconto;
		}
		var atual = parseFloat(multa) + parseFloat(total) - parseFloat(dc);
		var atualizado = Math.round(atual *100)/100;

		var desc = parseFloat(total)-parseFloat(dc);
		var desct = Math.round(desc *100)/100;

		if(dif > 0){
			document.getElementById("atraso").value=dif;
			document.getElementById("multa").value=multa;
			document.getElementById("atualizado").innerHTML=atualizado;
			document.getElementById("show").style.display="block";
			document.getElementById("atual").style.display="none";
		} 

		if( desconto !== "") 
		{
			document.getElementById("show").style.display="block";
			document.getElementById("atualizado").innerHTML=desct;
			document.getElementById("atual").style.display="none";
		}


		if(dif < 0 && desconto == "" )
		{
			document.getElementById("atraso").value= "";
			document.getElementById("multa").value= "";
			document.getElementById("show").style.display="none";
		}
		
		if(dtPag == "" && desconto == "")
		{
			document.getElementById("atraso").value= "";
			document.getElementById("multa").value= "";
			document.getElementById("show").style.display="none";

		}

	}
</script>

@endsection