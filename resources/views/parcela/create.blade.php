@extends('layouts.master2')

@section('content')
@if($errors->any())
<ul class="alert alert-danger">
	@foreach($errors->all() as $error)
	<li>{{$error}}</li>
	@endforeach
</ul>
@endif
<div>
	<div class="container-custom">
		<div class="col-lg-12">
			<div class="row">
				<h3>Tipo de parcela: </h3>
				<label  class="radio-inline">
					<input type="radio" name="tp_parcela" id="ph" checked >Parcela Honorários
				</label>

				<label class="radio-inline">
					<input type="radio" name="tp_parcela" id="pg">Parcela Ganho de Causa 
				</label>
			</div>
		</div>
	</div>
	<div id="hono">
		<!-- {!! Form::open(['route'=>['parcela.store', $idProcesso], 'method'=>'post', 'id'=>'colabForm']) !!} -->
		{!! Form::open(['route'=>['parcela.addParcela', $idProcesso], 'method'=>'post', 'id'=>'colabForm']) !!}
		@include('flash::message')
		<div class="container-custom">
			<input type="hidden" name="id_tp_parcela" value="1">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<h1 class="col-lg-12 well "> Cadastro de Parcela Honorários <i class="fa fa-usd dollar" aria-hidden="true"></i><span class="pull-right questionMark"><i class="fa fa-question-circle help" aria-hidden="true"></i></span>
			</h1>
			<div class="col-lg-12 well">
				<div class="row">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-3 form-group">
								<label>Valor total (R$)<span class="asterisk">*</span></label>
								<input type="text" name="demo" class="form-control money text-right" data-validation="required" id="total" onkeyup="parcela();"/>
							</div>

							<div class="col-sm-2 form-group">
								<label>Nº parcelas<span class="asterisk">*</span></label>				
								<input type='text' name="num_parcelas" value="1" class="form-control" data-validation="required number" id="num" onkeyup="this.value = this.value.replace(/0/g, '1'); parcela();"/>
							</div>
							<input type="hidden" name="primeira" id="parcel1">
							<input type="hidden" name="demais" id="par">

							<!-- <div class="col-sm-2 form-group">
								<label>Valor/parcela<span class="asterisk">*</span></label>				
								<input type='text' name="valor" class="form-control money" data-validation="required" id="par" readonly/>
							</div> -->

							<div class="col-sm-5 form-group">
								<label>Forma de pagamento<span class="asterisk">*</span></label>
								<select class="form-control" name="id_forma_pag" data-validation="required" id="forma" onkeyup="parcela();">
									<option value="">Selecione</option>
									@foreach($formaPag as $formaPags)
									<option value="{{$formaPags->id_forma_pag}}">{{$formaPags->forma_pag}}</option>
									@endforeach						
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-5 form-group">
								<label>1º Data de vencimento<span class="asterisk">*</span></label>
								<div class="input-group add-on col-md-12">
									<div class="input-group-btn">
										<a class="btn btn-default"><i class="fa fa-calendar"></i></a>
									</div>
									<input name="dt_venc" type="text" class="form-control dtParcel datepicker date" data-date-format="dd/mm/yyyy" data-validation="date required" data-validation-format="dd/mm/yyyy" placeholder="dd/mm/aaaa"  id="dt" onchange="parcela();" readonly>
								</div>
							</div>

							<div class="col-sm-3 form-group">
								<label>Juros/dia (%)<span class="asterisk">*</span></label>				
								<input type='text' name="porcent_juros" class="form-control" data-validation="number" data-validation-allowing="float" onkeyup="this.value = this.value.replace(/,/g, '.');"/>
							</div>
						</div>

					</div>
				</div>
			</div>

			<div class="form-group">
				<p><b><span class="asterisk">*</span>Campos de Preenchimento Obrigatórios </b><br><br></p>
			</div>

			<div class="text-center">
				<a href="{{ URL::to('/parcela/'.$idProcesso) }}" class="btn btn-lg btn-danger">Voltar <i class="fa fa-undo" aria-hidden="true"></i></a>
				&nbsp;&nbsp;&nbsp;
				<button type="submit" class="btn btn-lg btn-info">Gerar Parcelas <i class="fa fa-plus" aria-hidden="true"></i></button>
				<!-- <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-lg btn-info">Gerar Parcelas</a> -->
			</div>
			<br>
			<br>
		</div> 

		{!! Form::close() !!}
		<div class="modal fade helps" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h3 class="modal-title"><i class="fa fa-info-circle info" aria-hidden="true"></i> Informação</h3>
					</div>
					<div class="modal-body">
						<p>
							Parcela Honorários, são as despesas e custos do processo. Parcela Ganho de Causa, é quantia definida, no caso do ganho do processo.<br><br>
							<b>Valor total da parcela</b>: valor total dos honorários a serem divididos pelas parcelas, caso haja alguma mudança no valor, é necessário atualizar o valor em todas as parcelas.<br><br>
							<b> 1º Data de vencimento</b>: selecionando a 1º data de vencimento, todos os vencimentos posteriores serão no mesmo dia dos meses posteriores, até o término do pagamento. Se precisar alterar a data de pagamento de algum mês, será necessário alterar a parcela referente posteriormente. <br><br>
							<b> Juros/dia (%)</b>: porcentagem de juros que serão acrescentados na parcela por dia de atraso.<br><br>
						</p>
					</div>
				</div>  
			</div>
		</div>

	</div>

	<div style="display: none;" id="ganho">
		<!-- {!! Form::open(['route'=>['parcela.store', $idProcesso], 'method'=>'post', 'id'=>'colabForm']) !!} -->
		{!! Form::open(['route'=>['parcela.addParcela', $idProcesso], 'method'=>'post', 'id'=>'colabForm']) !!}
		@include('flash::message')
		<div class="container-custom">
			<input type="hidden" name="id_tp_parcela" value="2">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<h1 class="col-lg-12 well "> Cadastro de Parcela Ganho de Causa <i class="fa fa-usd dollar" aria-hidden="true"></i>
			</h1>

			<div class="col-lg-12 well">
				<div class="row">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-3 form-group">
								<label>Valor Ação (R$)<span class="asterisk">*</span></label>
								<input type="text" name="valor_acao" class="form-control money text-right" data-validation="required" id="valor_acao" data-validation="required" onkeyup="porcent();"/>
							</div>

							<div class="col-sm-2 form-group">
								<label>Porcento%<span class="asterisk">*</span></label>				
								<input type='text' name="porcentagem" class="form-control" data-validation="required" id="porcento" onkeyup="porcent();" />
							</div>

							<div class="col-sm-2 form-group">
								<label>Nº parcelas<span class="asterisk">*</span></label>				
								<input type='number' name="num_parcelas" value="1" class="form-control" data-validation="required" id="num_parcelas" onkeyup="this.value = this.value.replace(/0/g, '1'); porcent();"/>
							</div>

							<div class="col-sm-4 form-group">
								<label>Valor total a receber (R$)<span class="asterisk">*</span></label>				
								<input type='text' name="" class="form-control" data-validation="required" id="val_receber" readonly/>
							</div>

						</div>
						<div class="row">
							<!-- <div class="col-sm-3 form-group">
								<label>Valor/parcela<span class="asterisk">*</span></label>				
								<input type='text' name="valor" class="form-control" data-validation="required" id="parcela" readonly/>
							</div> -->
							<input type='hidden' name="primeira" data-validation="required" id="parcela" />
							<input type='hidden' name="demais" data-validation="required" id="demais" />
							<div class="col-sm-3 form-group">
								<label>Juros/dia (%)<span class="asterisk">*</span></label>				
								<input type="text" name="porcent_juros" class="form-control" data-validation="number" data-validation-allowing="float" onkeyup="this.value = this.value.replace(/,/g, '.');"/>
							</div>

							<div class="col-sm-4 form-group">
								<label>Forma de pagamento<span class="asterisk">*</span></label>
								<select class="form-control" name="id_forma_pag" data-validation="required">
									<option value="">Selecione</option>
									@foreach($formaPag as $formaPags)
									<option value="{{$formaPags->id_forma_pag}}">{{$formaPags->forma_pag}}</option>
									@endforeach						
								</select>
							</div>
							<div class="col-sm-4 form-group">
								<label>1º Data de vencimento<span class="asterisk">*</span></label>
								<div class="input-group add-on col-md-12" >
									<div class="input-group-btn">
										<a class="btn btn-default"><i class="fa fa-calendar"></i></a>
									</div>
									<input name="dt_venc" type="text" class="form-control dtParcel date" data-validation="date required" data-validation-format="dd/mm/yyyy" placeholder="dd/mm/aaaa" readonly>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="form-group">
				<p><b><span class="asterisk">*</span>Campos de Preenchimento Obrigatórios </b><br><br></p>
			</div>

			<div class="text-center">
				<a href="{{ URL::to('/parcela/'.$idProcesso) }}" class="btn btn-lg btn-danger">Voltar <i class="fa fa-undo" aria-hidden="true"></i></a>
				&nbsp;&nbsp;&nbsp;
				<button type="submit" class="btn btn-lg btn-info">Gerar Parcelas <i class="fa fa-plus" aria-hidden="true"></i></button>
			</div>
			<br>
			<br>
		</div> 
		{!! Form::close() !!}
	</div>
	@endsection

	@section('content_js')
	<script type="text/javascript" >
		$(document).ready(function() {
			$('input[type="radio"]').click(function() {
				if($(this).attr('id') == 'ph') {
					$('#hono').show();  
					$('#ganho').hide();          
				}
				else {
					$('#hono').hide();
					$('#ganho').show();  
				}
			});
		});

		function porcent() 
		{
			var valor_acao = document.getElementById('valor_acao').value;
			var num_parcelas = document.getElementById('num_parcelas').value;
			var porcento = document.getElementById('porcento').value;
			var result = Math.round(parseFloat(valor_acao) * (parseFloat(porcento)/100)*100)/100;
			var result2 = Math.round(result/parseInt(num_parcelas)*100)/100;

			var pp = parseFloat(result) - ((num_parcelas - 1)*result2);
			var primeira = Math.round(pp* 100) / 100;

			if (!isNaN(result)) {
				document.getElementById('val_receber').value = result;
			}

			if (!isNaN(result2) && !isNaN(primeira)) {
				document.getElementById('parcela').value = primeira;
				document.getElementById('demais').value = result2;
			}
		}

		function parcela()
		{
			var total = document.getElementById('total').value;
			total1 = total.replace('.','');
			total = total1.replace(',','.');
			var num = document.getElementById('num').value;
			var dt = document.getElementById('dt').value;
			var va= parseFloat(total)/parseInt(num);
			var val = Math.round(va * 100) / 100;
			var p = parseFloat(total) - ((num - 1)*val);
			var parcela1 = Math.round(p * 100) / 100;

			if(!isNaN(val) )
			{
				document.getElementById('par').value = val;
			}

			if (!isNaN(parcela1)) {
				document.getElementById('parcel1').value = parcela1;
			}

		}
	</script>

	@endsection