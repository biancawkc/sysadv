 @extends('layouts.master2')
 @section('content')
 {!! Form::open(['route'=>['parcela.store', $idProcesso], 'method'=>'post', 'id'=>'colabForm']) !!} 
 <input type="hidden" name="primeira" value="{{$primeira}}">
 <input type="hidden" name="valor" value="{{$demais}}">
 <input type="hidden" name="id_forma_pag" value="{{$forma}}">
 <input type="hidden" name="id_tp_parcela" value="{{$tipo}}">
 <input type="hidden" name="porcentagem" value="{{$porcentagem}}">
 <input type="hidden" name="dt_venc" value="{{$data}}">
 <input type="hidden" name="num_parcelas" value="{{$qtd}}">
 <input type="hidden" name="juros" value="{{$juros}}">

 <div class="container-custom">
 @if($tipo == 1)
 <h1 class="col-lg-12 well ">Parcela(s) Honorários <i class="fa fa-usd dollar" aria-hidden="true"></i></h1>
 @else
 <h1 class="col-lg-12 well "> Cadastro de Parcela Ganho de Causa <i class="fa fa-usd dollar" aria-hidden="true"></i></h1>
 @endif
 	<table class="table table-striped table-bordered" style="width: 700px;">
 		<tbody>
 			<tr>
 				<th class="col-md-3">Parcela</th>
 				<th class="col-md-3">Valor (R$)</th>
 				<th class="col-md-3">Data Vencimento</th>
 			</tr>
 			<tr>
 				<td>1 de {{$qtd}}</td>
 				<td>{{$primeira}}</td>
 				<td>{{date('d/m/Y', strtotime($data))}}</td>
 			</tr>
 			<?php for($j = $qtd-1; $i <= $j; $i++ )
 			{ ?>
 			<tr>
 				<td>{{$i+1}} de {{$qtd}}</td>	
 				<td>{{$demais}}</td>
 				<?php $time = strtotime($data);
 				$date = strtotime('+'.$i.' month', $time);
 				$dt_venc = date("Y-m-d", $date);?>
 				<td>{{date('d/m/Y', strtotime($dt_venc))}}</td>
 			</tr>
 			<?php }?>

 		<!-- <tr>
 		<td>{{$primeira}}</td>
 		<td>hell</td>
 		<td>hell</td>
 		</tr>
 	-->
 </tbody>
</table>
<p>Será cobrado <b>{{$juros}}%</b> acima do valor da(s) parcela(s) por dia de atraso de pagamento.</p>
<br>
<div class="text-center">
				<a href="{!! URL::previous() !!}" class="btn btn-lg btn-danger">Voltar <i class="fa fa-undo" aria-hidden="true"></i></a>
				&nbsp;&nbsp;&nbsp;
				<button type="submit" class="btn btn-lg btn-info">Cadastrar <i class="fa fa-plus" aria-hidden="true"></i></button>
			</div>
</div>
{!! Form::close() !!}
@endsection


