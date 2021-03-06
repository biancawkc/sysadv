
<div class="container-custom">
	<div class="col-lg-12">
		<div class="row">
			<span class="link"><b>Processo: <a href="{{URL::to('/processo/'.$idProcesso.'/show')}}" target="_blank">{{$processo->numero}}</a></span>
				<hr>
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
			<h1 class="col-lg-12 well "> Cadastro de Parcela Honorários <i class="fa fa-usd dollar" aria-hidden="true"></i>
			</h1>
			<div class="col-lg-12 well">
				<div class="row">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-3 form-group">
								<label>Valor total parcela<span class="asterisk">*</span></label>
								<input type='text' name="total" class="form-control money text-right" data-validation="required" id="total" onkeyup="parcela();"/>
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
									<input name="dt_venc" type="text" class="form-control date dtParcel" data-validation="date required" data-validation-format="dd/mm/yyyy" placeholder="dd/mm/aaaa"  id="dt" onchange="parcela();" readonly>
								</div>
							</div>

							<div class="col-sm-3 form-group">
								<label>% Juros/dia<span class="asterisk">*</span></label>				
								<input type='text' name="juros" class="form-control" data-validation="number" data-validation-allowing="float" onkeyup="this.value = this.value.replace(/,/g, '.');"/>
							</div>
						</div>

					</div>
				</div>
			</div>

			<div class="form-group">
				<p><b><span class="asterisk">*</span>Campos de Preenchimento Obrigatórios </b><br><br></p>
			</div>

			<div class="text-center">
				<a data-dismiss="modal" class="btn btn-lg btn-danger">Voltar <i class="fa fa-undo" aria-hidden="true"></i></a>
				&nbsp;&nbsp;&nbsp;
				<button type="submit" class="btn btn-lg btn-info">Gerar Parcelas <i class="fa fa-plus" aria-hidden="true"></i></button>
				<!-- <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-lg btn-info">Gerar Parcelas</a> -->
			</div>
			<br>
			<br>
		</div> 

		{!! Form::close() !!}
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
								<input type='text' name="valor_acao" class="form-control money text-right" id="valor_acao" onkeyup="porcent();" data-validation="required"/>
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
								<input type='text' name="" class="form-control money" data-validation="required" id="val_receber" readonly />
								<!-- <label id="val_receber"></label> -->
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
								<label>% Juros/dia<span class="asterisk">*</span></label>				
								<input type='text' name="juros" class="form-control" data-validation="number" data-validation-allowing="float"  onkeyup="this.value = this.value.replace(/,/g, '.');"/>
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
									<input name="dt_venc" type="text" class="form-control date dtParcel" data-validation="date required" data-validation-format="dd/mm/yyyy" placeholder="dd/mm/aaaa" readonly>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="form-group">
				<p><b><span class="asterisk">*</span>Campos de Preenchimento Obrigatórios </b><br><br></p>
			</div>

			<ul class="buttons" style="margin-left: 28%">
				<li><a data-dismiss="modal" class="btn btn-lg btn-danger">Voltar <i class="fa fa-undo" aria-hidden="true"></i></a></li>
				
				<li><button type="submit" class="btn btn-lg btn-info">Gerar Parcelas <i class="fa fa-plus" aria-hidden="true"></i></button></li>
			</ul>
			<br>
			<br>
		</div> 
		{!! Form::close() !!}
	</div>

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
			valor_acao = valor_acao.replace('.','');
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