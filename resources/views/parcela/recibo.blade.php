		<html>
		<head>
			<link rel="icon" type="image/png" href="{{ asset ('../resources/assets/images/rw.png')}}" />
			<style>

      		#retangulo { position: relative;  width: 700px; height:auto;  border: 1.2px solid black; padding-left: 25px; display: inline-block; font-size: 18px;}
      		p {line-height: 200%; }

      		#header { font-size: 13px;}
      		</style>
		</head>
		<body>
		<p>
			<div id="retangulo">
				<table id="header">
				<tr>
				<td width="317"><img src="{{ asset ('../resources/assets/images/rw_adv_minor.png')}}" style="width: 290px; height: 47px;"></td>
				<td style="text-align: center;">Ronei Juliano Fogaça Weiss - OAB/PR 41.955<br>
				Av. Viconde de Taunay, 576, CEP: 84010-760 <br>weissronei@ig.com.br / Tel.: (42) 3222-0992</td>
				</tr>
				</table> 
				<span style="text-align: center;"><h2>RECIBO</h2></span>
				<span style="padding-left: 40px;">Parcela <b>Nº  {{$parcela->num_parcela}}</b> </span><span style="margin-left: 420px;">Valor: R$ {{$valorF}}</span> 
				<hr>
				<br>
				<p style="margin-left: 10px; margin-right:10px;">
				Recebemos de <b>{{$jurid}}{{$fis}}</b>
				a importância de <b>{{$valores}}</b>
				no dia <b>{{date('d/m/Y', strtotime($parcela->dt_pag))}}</b> 
				referente ao processo número <b>{{$processo->numero}}</b>
				com vencimento em {{date('d/m/Y', strtotime($parcela->dt_venc))}}.<br>
				Para maior clareza firmamos o presente <br><br>
				
				<span style="margin-left: 200px;">Ponta Grossa, {{strftime('%d de %B de %Y', strtotime($parcela->dt_pag))}}</span><br><br>				
				Assinatura: __________________________________________________<br><br>
				</p>
			</div>
		</p>
		</body>
		</html>