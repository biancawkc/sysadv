<html>
		<head>
			<title>Relatório</title>
			<link rel="icon" type="image/png" href="{{ asset ('../resources/assets/images/rw.png')}}" />
			<script src="{{asset('../resources/assets/js/jquery.mask.js')}}"></script>
			<script src="{{asset('../resources/assets/js/inc.js')}}"></script>
			<style>
				@page { margin: 45px 50px 40px; }
				#retangulo { position: relative;  width: 700px; height:auto;  border: 1.2px solid black; padding-left: 25px; display: inline-block; font-size: 18px;}
				p {line-height: 200%; }

				#header { font-size: 13px;}
				/*#header {position: fixed; display: block; font-size: 13px; }*/

				.table td {
					border: 1px solid black;
					padding: 9px;
					border-collapse: collapse;
					
				}
				.table th {
					border: 1px solid black;
					padding: 9px;
					border-collapse: collapse;
					
				}
				table{page-break-inside: avoid;}

				#content {margin-bottom:50px; }

				.money{text-align: right;}

				/*.total
				{
					text-align: right;
				}*/

				.center
				{
					text-align: center;
				}

                  #footer {position: fixed; left: 0px; bottom: -40px; right: 0px; height: 40px; background-color: #d9d9d9; }
                  #footer .page:after { content: counter(page, upper-roman); }
                  
                  .page-num:before { 
                      content: counter(page); 
                   }
                  
			</style>
		</head>
		<body>
                <div id="footer" style="width:120%; margin-left: -10%; padding-left:10%">
                <div style="position: fixed; left: 0px; bottom: -52px; right: -0px; height: 45px; color: #000000; padding-left:15px; padding-top:15px;"> 
                    {{date("d/m/Y")}}</div>
                <div style="position: fixed; left: 300px; bottom: -52px; right: -0px; height: 45px; color: #000000; padding-left:15px; padding-top:15px;">
                    Pág. <span class="page-num"></span>
                </div>                

                        <div style="text-align: right; position: fixed; left: 0px; bottom: -52px; right: -0px; height: 45px; color: #000000; padding-left:15px; padding-top:15px;">Processo: {{$processo->numero}}</div>
                </div>
		
				<table id="header">
					<tr>
						<td width="317"><img src="{{ asset ('../resources/assets/images/rw_adv_minor.png')}}" style="width: 290px; height: 47px;"></td>
						<td style="text-align: center;">Ronei Juliano Fogaça Weiss - OAB/PR 41.955<br>
							Av. Viconde de Taunay, 576, CEP: 84010-760 <br>weissronei@ig.com.br / Tel.: (42) 3222-0992</td>
						</tr>
					</table> 
					<br>
					<hr>
					<br>
					<p id="content">
					<h2>Relatório do Processo: {{$processo->numero}}</h2>
					<h4><b>Estado</b>: {{$estadoProcesso->desc_est_processo}}</h4>
					<table class="table" style="width: 700px;">
						
						<tr>
							<th>Nome da ação</th>
							<td colspan="3">{{$processo->nome_acao}}</td>
						</tr>

						<tr>
							<th style="width: 25%">Justiça gratuita</th>
							@if($processo->justica_grat == "1")
							<td style="width: 32%;">Sim</td>
							@else
							<td>Não</td>
							@endif
							<th style="width: 25%">Ação gratuita </th>
							@if($processo->acao_grat == "1")
							<td style="width: 32%;">Sim</td>
							@else
							<td>Não</td>
							@endif
						</tr>

						<tr>
							<th>Data de início</th>
							<td>{{ date('d/m/Y', strtotime($processo->dt_inicio))}} </td>
							<th>Data final</th>
							@if(!is_null($processo->dt_final))
							<td>{{ date('d/m/Y', strtotime($processo->dt_final))}}</td>
							@else
							<td></td>
							@endif
						</tr>

						<tr>
							<th>Justiça</th>
							<td colspan="3">{{$justica->nm_justica}}</td>
						</tr>

						<tr>
							<th>Comarca</th>
							<td colspan="3">{{$comarca->comarca}}</td>
						</tr>

						<tr>
							<th>Vara</th>
							<td colspan="3">{{$vara->vara}}</td>
						</tr>

						<tr>
							<th>Descrição</th>
							<td colspan="3">{{$processo->desc_processo}}</td>
						</tr>
						
					</table>
					<br>
					<h3>Cliente(s)</h3>
					@if (!is_null($pessoaJuridicaC))
					@foreach($pessoaJuridicaC as $value)
					<table class="table" style="width: 700px;">
						<tr>
							<th style="width: 25%">Razão Social</th>
							<td colspan="3">{{$value->razao_social}}</td>
						</tr>

						<tr>
							<th style="width: 25%">Nome fantasia</th>
							<td colspan="3">{{$value->nm_fantasia}}</td>
						</tr>
						<tr>
							<th>CNPJ</th>
							<td colspan="3" class="cnpj">{{$value->cnpj}}</td>
						</tr>
						<tr>
							<th>Inscrição estadual</th>
							<td colspan="3">{{$value->ins_estadual}}</td>
						</tr>
						<tr>
							<th>Descrição de Atividades</th>
							<td colspan="3">{{$value->desc_atividades}}</td>
						</tr>

						<tr>
							<th class="col-md-4">Email</th>
							<td colspan="3">{{$value->email}}</td>
						</tr>

						<tr>
							<th>Telefone(s)</th>
							<td colspan="3">{{$value->telefones}}</td>
						</tr>

						<tr>
							<th>CEP</th>
							<td>{{$value->cep}}</td>
							<th>Bairro</th>
							<td>{{$value->bairro}}</td>
						</tr>

						<tr>
							<th>Cidade</th>
							<td>{{$value->cidade}}</td>
							<th style="width: 25%">UF</th>
							<td>{{$value->uf}}</td>
						</tr>

						<tr>
							<th>Logradouro</th>
							<td colspan="3">{{$value->logradouro}}</td>
						</tr>
						<tr>
							<th>Número</th>
							<td>{{$value->numero}}</td>
							<th>Complemento</th>
							<td>{{$value->complemento}}</td>
						</tr>
						
					</table>
					@endforeach
					@endif

					@if(!is_null($pessoaFisicaC)) 
					@foreach($pessoaFisicaC as $k => $values)
					
					<table class="table" style="width: 100%">
	
							<tr>
								<th style="width: 25%">Nome</th>
								<td colspan="3">{{$values->nome}}</td>
							</tr>
							<tr>
								<th style="width: 20%">RG</th>
								<td>{{$values -> rg}}</td>
								<th style="width: 20%">Orgão Exp.</th>
								<td>{{$values -> orgao_exp}}</td>
							</tr>
							<tr>
								<th>CPF</th>
								<td>{{$values -> cpf}}</td>
								<th>Estado civil</th>
								<td>{{$values -> estados}}</td>
							</tr>
							<tr>
								<th>Data Nasc.</th>
								<td colspan="3">{{ date('d/m/Y', strtotime($values->dt_nasc)) }}</td>
							</tr>
				
						<tr>
							<th class="col-md-4">Email</th>
							<td colspan="3">{{$values->email}}</td>
						</tr>

						<tr>
							<th>Telefone(s)</th>
							<td colspan="3">{{$values->telefones}}</td>
						</tr>

							<tr>
								<th style="width: 20%">CTPS</th>
								<td colspan="3">{{$values -> ctps}}</td>
							</tr>
							<tr>
								<th>CBO</th>
								<td>{{$values->cbo}}</td>
								<th style="width: 20%">Remuneração</th>
								<td></td>
							</tr>
							<tr>
								<th>Profissão</th>
								<td colspan="3">{{$values->profis}}</td>
							</tr>
						<tr>
		
							<th style="width: 20%">CEP</th>
							<td>{{$values->cep}}</td>
							<th>Bairro</th>
							<td>{{$values->bairro}}</td>
						</tr>

						<tr>
							<th>Cidade</th>
							<td>{{$values->cidade}}</td>
							<th style="width: 15%">UF</th>
							<td>{{$values->uf}}</td>
						</tr>

						<tr>
							<th >Logradouro</th>
							<td colspan="3">{{$values->logradouro}}</td>
						</tr>
						<tr>
							<th>Número</th>
							<td>{{$values->numero}}</td>
							<th>Complemento</th>
							<td>{{$values->complemento}}</td>
						</tr>
				</table>

				@endforeach
				@endif
				<br>
				<h3>Parte(s) Adversa(s)</h3>
				@if (!is_null($pessoaJuridicaA))
				@foreach($pessoaJuridicaA as $val)

				<table class="table" style="width: 100%">
					<tr>
						<th style="width: 25%">Razão Social</th>
						<td colspan="3">{{$val->razao_social}}</td>
					</tr>

					<tr>
						<th class="col-md-4">Nome fantasia</th>
						<td colspan="3">{{$val->nm_fantasia}}</td>
					</tr>
					<tr>
						<th>CNPJ</th>
						<td colspan="3">{{$val->cnpj}}</td>
					</tr>
					<tr>
						<th>Inscrição estadual</th>
						<td colspan="3">{{$val->ins_estadual}}</td>
					</tr>
					<tr>
						<th>Descrição de Atividades</th>
						<td colspan="3">{{$val->desc_atividades}}</td>
					</tr>


					<tr>
						<th class="col-md-4">Email</th>
						<td colspan="3">{{$val->email}}</td>
					</tr>

					<tr>
						<th>Telefone</th>
						<td colspan="3">{{$val->telefones}}</td>
					</tr>


					<tr>
						<th style="width: 20%">CEP</th>
						<td>{{$val->cep}}</td>
						<th>Bairro</th>
						<td>{{$val->bairro}}</td>
					</tr>

					<tr>
						<th>Cidade</th>
						<td>{{$val->cidade}}</td>
						<th style="width: 15%">UF</th>
						<td>{{$val->uf}}</td>
					</tr>

					<tr>
						<th>Logradouro</th>
						<td colspan="3">{{$val->logradouro}}</td>
					</tr>
					<tr>
						<th>Número</th>
						<td>{{$val->numero}}</td>
						<th>Complemento</th>
						<td>{{$val->complemento}}</td>
					</tr>
				</table>
				@endforeach
				@endif

				@if(!is_null($pessoaFisicaA)) 
				@foreach($pessoaFisicaA as $vals)
				<table class="table" style="width: 100%">
					<tr>
						<th style="width: 25%">Nome</th>
						<td colspan="3">{{$vals->nome}}</td>
					</tr>
					<tr>
						<th style="width: 25%">RG</th>
						<td>{{$vals -> rg}}</td>
						<th style="width: 25%">Orgão Exp.</th>
						<td>{{$vals -> orgao_exp}}</td>
					</tr>
					<tr>
						<th>CPF</th>
						<td>{{$vals -> cpf}}</td>
						<th>Estado civil</th>
						<td>{{$vals -> estados}}</td>
					</tr>
					<tr>
						<th>Data Nasc.</th>
						<td colspan="3">{{ date('d/m/Y', strtotime($vals->dt_nasc)) }}</td>
					</tr>

					<tr>
						<th>Email</th>
						<td colspan="3">{{$vals->email}}</td>
					</tr>

					<tr>
						<th>Telefone(s)</th>
						<td colspan="3">{{$vals->telefones}}</td>
					</tr>

					<tr>
						<th style="width: 20%">CTPS</th>
						<td colspan="3">{{$vals -> ctps}}</td>
					</tr>
					<tr>
						<th>CBO</th>
						<td>{{$vals->cbo}}</td>
						<th>Remuneração</th>
						<td></td>
					</tr>
					<tr>
						<th>Profissão</th>
						<td colspan="3">{{ucfirst(strtolower($vals->profis))}}</td>
					</tr>
					<tr>
						<th>CEP</th>
						<td>{{$vals->cep}}</td>
						<th>Bairro</th>
						<td>{{$vals->bairro}}</td>
					</tr>

					<tr>
						<th>Cidade</th>
						<td>{{$vals->cidade}}</td>
						<th>UF</th>
						<td>{{$vals->uf}}</td>
					</tr>

					<tr>
						<th >Logradouro</th>
						<td colspan="3">{{$vals->logradouro}}</td>
					</tr>
					<tr>
						<th>Número</th>
						<td>{{$vals->numero}}</td>
						<th>Complemento</th>
						<td>{{$vals->complemento}}</td>
					</tr>
				</table>
				@endforeach
				@endif
				<br>
				<h3>Etapas</h3>
				<table class="table" style="width: 100%">
					<tr>					
						<th style="width: 30%">Nome</th>						
						<th style="width: 20%">Data Início</th>						
						<th style="width: 20%">Data Final</th>		
						<th style="width: 30%">Descrição</th>				
					</tr>
					
					@if(!$etapa->isEmpty()) 
					@foreach($etapa as  $etapas)
					<tr>
						<td>{{$etapas->nm_etapa}} </td>
						<td>{{ date('d/m/Y', strtotime($etapas -> dt_etapa))}}</td>
						<td>{{ date('d/m/Y', strtotime($etapas -> dt_prazo))}}</td>
						<td>{{$etapas->desc_etapa}} </td>
					</tr>
					@endforeach
					
					@elseif($etapa->isEmpty())
					<tr>
					<td colspan="4" class="center"><b>Não possui etapas cadastradas</b></td>
					</tr>
					@endif
				</table>

				<br>
				<h3>Despesas</h3>
				<table class="table" style="width: 100%">
					<tr>					
						<th style="width: 20%">Valor (R$)</th>						
						<th style="width: 25%">Data</th>						
						<th>Descrição</th>						
					</tr>
					
					@if(!$despesa->isEmpty()) 
					@foreach($despesa as  $despesas)
					<tr>
						<td class="money"> R$ {{number_format($despesas->valor,2,",",".")}}</td>
						<td>{{ date('d/m/Y', strtotime($despesas -> dt_despesa))}}</td>
						<td>{{$despesas->desc_despesa}} </td>
					</tr>
					@endforeach
					<tr>
					<td colspan="3" class="money"><b>Total: R$ {{number_format($despesaTotal,2,",",".")}}</b></td>
					</tr>
					@elseif($despesa->isEmpty())
					<tr>
					<td colspan="3" class="center"><b>Não possui despesas cadastradas</b></td>
					</tr>
					@endif
				</table>
				<h3>Parcelas Honorários</h3>
				<table class="table" style="width: 100%">

					<tr>
						<th style="width: 12%">Número</th>
						
						<th style="width: 17%">Valor</th>

						<th style="width: 17%">Desconto</th>

						<th style="width: 17%">Juros</th>
						
						<th>Data Vencimento</th>
						
						<th>Data Pagamento</th>
						
					</tr>
					
					@if(!$parcelaH->isEmpty()) 
					@foreach($parcelaH as  $parcelasH)
					<tr>
						<td>{{$parcelasH -> num_parcela}}</td>
						<td class="money">R$ {{number_format($parcelasH -> valor,2,",",".")}} </td>
						<td>R$ {{number_format($parcelasH -> desconto,2,",",".")}}</td>
						<td>R$ {{number_format($parcelasH -> valor_juros,2,",",".")}}</td>
						<td>{{ date('d/m/Y', strtotime($parcelasH -> dt_venc))}}</td>
						@if(!is_null($parcelasH->dt_pag))
						<td>{{ date('d/m/Y', strtotime($parcelasH -> dt_pag))}}</td>
						@else
						<td> - </td>
						@endif
					</tr>
					@endforeach
					<tr>
					<td colspan="6" class="total money"><b>Total: R$ {{number_format($parcelaHtotal,2,",",".")}}</b></td>
					</tr>
					<tr>
					<td colspan="6" class="money"><b>Total à receber: R$ {{number_format($parcelaRece,2,",",".")}}</b></td>
					</tr>
					<tr>
					<td colspan="6" class="money"><b>Total de descontos concedidos: R$ {{number_format($parcelaHdesc,2,",",".")}}</b></td>
					</tr>
					<tr>
					<td colspan="6" class="money"><b>Total de juros aplicados: R$ {{number_format($parcelaHjuro,2,",",".")}}</b></td>
					</tr>
					<tr>
					<td colspan="6" class="money"><b>Total recebido: R$ {{number_format($parcelaHsum,2,",",".")}}</b></td>
					</tr>
					@elseif($parcelaH->isEmpty())
					<tr>
					<td colspan="6" class="center"><b>Não possui parcelas honorários cadastradas</b></td>
					</tr>
					@endif
				</table>
				<br>
				<h3>Parcelas Ganho de Causa</h3>
				<table class="table" style="width: 100%">

					<tr>
						<th style="width: 12%">Número</th>
						
						<th style="width: 17%">Valor</th>

						<th style="width: 17%">Desconto</th>

						<th style="width: 17%">Juros</th>						
						<th>Data Vencimento</th>						
						<th>Data Pagamento</th>						
					</tr>
					
					@if(!$parcelaG->isEmpty()) 
					@foreach($parcelaG as  $parcelasG)
					<tr>
						<td>{{$parcelasG -> num_parcela}}</td>
						<td class="money">R$ {{number_format($parcelasG->valor,2,",",".")}}</td>
						<td>{{ date('d/m/Y', strtotime($parcelasG -> dt_venc))}}</td>
						@if(!is_null($parcelasG->dt_pag))
						<td>{{ date('d/m/Y', strtotime($parcelasG -> dt_pag))}}</td>
						@else
						<td> - </td>
						@endif
					</tr>
					@endforeach
					<tr>
					<td colspan="6" class="total money"><b>Total: R$ {{ number_format($parcelaGtotal,2,",",".")}}</b></td>
					</tr>
					<tr>
					<td colspan="6" class="money"><b>Total à receber: R$ {{ number_format($parcelaGRece,2,",",".")}}</b></td>
					</tr>
					<tr>
					<td colspan="6" class="money"><b>Total de descontos concedidos: R$ {{number_format($parcelaGdesc,2,",",".")}}</b></td>
					</tr>
					<tr>
					<td colspan="6" class="money"><b>Total de juros aplicados: R$ {{number_format($parcelaGjuro,2,",",".")}}</b></td>
					</tr>
					<tr>
					<td colspan="6" class="money"><b>Total recebido: R$ {{number_format($parcelaGsum,2,",",".")}}</b></td>
					</tr>
					@elseif($parcelaG->isEmpty())
					<tr>
					<td colspan="6" class="center"><b>Não possui parcelas ganho de causa cadastradas</b></td>
					</tr>
					@endif

				</table>
			</p>
		</body>
		</html>