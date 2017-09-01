 @extends('layouts.master2')
 @section('content')
 <div class="container">
   @include('flash::message')
   <h1 class="col-lg-12 well text-center">Parcelas de Pagamento <i class="fa fa-money" aria-hidden="true"></i></h1>
   <br>
   <h2 class="text-center"><b>Processo: {{$processo->numero}} </b></h2>
 
    <a href="{{ URL::to('parcela/'.$idProcesso.'/create') }}" class="btn btn-lg btn-success"><i class="fa fa-plus" aria-hidden="true"></i></a>
    <br><br>
   <table class="table table-striped table-bordered text-center tblCadastro" >
    <thead>
        <tr>
           <th>Nº</th>
           <th>Valor</th>
           <th>Data Vencimento</th>
           <th>Data Pagamento</th>
           <th>Forma de Pagamento</th>
           <th>Tipo</th>
           <th>Ações</th>
       </tr>
   </thead>
   <tbody>
    @if (!$parcela->isEmpty())
    @foreach($parcela as $key => $value)
    <tr>
        <td>{!! $value->num_parcela !!}</td>
        <td>R$ {!! $value->valor !!}</td>
        <td>{!! date('d/m/Y', strtotime($value->dt_venc)) !!}</td>
        @if(!empty($value->dt_pag))
        <td>{!! date('d/m/Y', strtotime($value->dt_pag)) !!}</td>
        @else
        <td>-</td>
        @endif
        <td></td>
        <td></td>
        <td><a href="{{ URL::to('/parcela/' . $value->id_parcela . '/edit') }}" class="btn btn-lg btn-info" data-toggle="tooltip" data-placement="top" title="Atualizar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> &nbsp;&nbsp;
        @if( $value->dt_pag == NULL)
        <button class="btn btn-lg btn-info" data-toggle="tooltip" data-placement="top" title="Recibo" disabled><i class="fa fa-file-o" aria-hidden="true"></i></button> 
        @else
        <a target="_blank" href="{{ URL::to('/parcela/' . $value->id_parcela . '/recibo') }}" class="btn btn-lg btn-info" data-toggle="tooltip" data-placement="top" title="Recibo"><i class="fa fa-file-o" aria-hidden="true"></i></a>
        @endif
        </td>
    </tr>
    @endforeach
    @else
    <td colspan="3">
        Não há registros
    </td>
    @endif
</tbody>
</table>
<br>
<a href="{{ URL::to('parcela/'.$idProcesso.'/create') }}" class="btn btn-lg btn-success"><i class="fa fa-plus" aria-hidden="true"></i></a>
</div>
<br>
@endsection

@section('content_js')

@endsection


