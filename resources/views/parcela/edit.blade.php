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
<input type="hidden" name="advsersa_pag" value="0">
<div class="container-custom">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<h2><b>Processo: <a href="{{URL::to('/processo/'.$processo->id_processo.'/show')}}" target="_blank">{{$processo->numero}}</a> </b><a data-toggle="collapse" data-target="#demo" class="btn btn-sm btn-info" id="open">Expandir</a><a data-toggle="collapse" data-target="#demo" class="btn btn-sm btn-warning" id="close">Esconder</a></h2>
	<div class="row">
		<div class="col-lg-9">
			<div id="demo" class="collapse">
				<p><b>Estado Processo</b>: {{$processo->desc_est_processo}} / <b>Nome Ação</b>: {{$processo->nome_acao}} / <b>Jutiça:</b> {{$processo->nm_justica}} / <b>Comarca:</b> {{$processo->comarca}} / <b>Vara:</b> {{$processo->vara}} / <b>Justiça Gratuita:</b> @if($processo->justica_grat == 1) Sim @else Não @endif / <b>Ação Gratuita:</b> @if($processo->acao_grat == 1) Sim @else Não @endif / <b>Data Início</b>: {{ date('d/m/Y', strtotime($processo->dt_inicio)) }} / <b>Data Final</b>: @if(!empty($processo->dt_final)){{ date('d/m/Y', strtotime($processo->dt_final)) }}@else - @endif </p>
			</div>
		</div>
	</div>
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
							<input type="text" name="" class="form-control text-right" data-validation="required" value="{{ $valores}}" readonly  id="valor" onkeyup="GetDays(); Pag();"/>
						</div>
						<input type="hidden" name="valor" value="{{ str_replace(',','.', $valores)}}">
						<div class="col-sm-2 form-group">
							<label>Nº<span class="asterisk">*</span></label>				
							<input type="number" name="num_parcela" value="{{$parcela->num_parcela}}" class="form-control" data-validation="required" readonly/>
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
							@if($parcela->adversa_pag == 1)
							<label class="checkbox-inline"><input type="checkbox" name="adversa_pag" value="1" checked>Parte Adversa</label>
							@else
							<label class="checkbox-inline"><input type="checkbox" name="adversa_pag" value="1">Parte Adversa</label>
							@endif
						</div>		
					</div>

					<div class="row">
						<div class="col-sm-3 form-group">
							<label>% Juros/dia<span class="asterisk">*</span></label>				
							<input type='text' name="porcent_juros" class="form-control" data-validation="required number" value="{{$parcela->porcent_juros}}" readonly id="juros" onkeyup="GetDays()"/>
						</div>

						<div class="col-sm-2 form-group null">
							<label>Dias atraso</label>				
							<input type="text" name="dias_atraso" class="form-control" readonly id="atraso" value="{{$parcela->dias_atraso}}" />
						</div>

						<div class="col-sm-2 form-group null">
							<label>Juros (R$)</label>				
							<input type="text" name="valor_juros" class="form-control text-right" readonly id="multa" value="{{$parcela->valor_juros}}" id="jur" onkeyup="Pag();" />
							<!-- <input type="text" name="valor_juros" id="juros" value="{{$parcela->valor_juros}}"> -->
						</div>

						<div class="col-sm-3 form-group null">
							<label>Desconto (R$)</label>				
							<input type="text" name="" class="form-control money text-right" value="{{$descontos}}" id="desconto" onkeyup="GetDays(); Pag();"  />
							<input type="hidden" name="desconto" id="discount" value="{{$parcela->desconto}}">
						</div>
					</div>
				</div>
			</div>
		</div>
	
			<h4 class="col-lg-12 well" style="display: none;" id="show">Valor Atualizado: R$ <b><span id="atualizado"></span></b></h4> 

			@if(!is_null($parcela->desconto) || !is_null($parcela->valor_juros))
			<h4 class="col-lg-12 well" id="atual">Valor Atualizado: R$ <b>{{$valorF}}</b></h4>
			@endif
		<p>Data de criação: {{date('d/m/Y H:i:s', strtotime($parcela->dt_criacao))}} &nbsp;&nbsp;&nbsp; Última alteração feita em {{date('d/m/Y H:i:s', strtotime($parcela->dt_atualizacao))}} por {{$usuario->username}} </p>

		<div class="form-group">
			<p><b><span class="asterisk">*</span>Campos de Preenchimento Obrigatórios </b><br><br></p>
		</div>
		
		<div class="row text-center">
			<div class="col-sm-3 form-group">
			</div>
						<div class="col-sm-2 form-group">
							<a href="{{ URL::to('/parcela/'.$parcela->id_processo) }}" class="btn btn-lg btn-danger">Voltar <i class="fa fa-undo" aria-hidden="true"></i></a>
						</div>

						<div class="col-sm-2 form-group">
							<button type="submit" class="btn btn-lg btn-info">Salvar <i class="fa fa-check" aria-hidden="true"></i></button>
						</div>

						<div class="col-sm-2 form-group">
							@if(!empty($parcela->dt_pag))
							<a target="_blank" href="{{ URL::to('/parcela/' .$parcela->id_parcela. '/recibo') }}" class="btn btn-lg btn-success">Recibo  <i class="fa fa-sticky-note-o" aria-hidden="true"></i></a>
							@else
							<button class="btn btn-lg btn-success" disabled>Recibo <i class="fa fa-sticky-note-o" aria-hidden="true"></i></button>
							@endif
						</div>
					</div>
				
	</div> 
	
	


</form> 
{!! Form::close() !!}
@endsection

@section('content_js')
<script src="{{asset('../resources/assets/js/actions/parcela.js')}}" type="text/javascript"></script>
<script type="text/javascript" >
$(document).ready(function() {
	$pag = {{$parcela->id_forma_pag}}
	$("#formaPag").val($pag);
});
</script>

@endsection