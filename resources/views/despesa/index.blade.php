 @extends('layouts.master2')
 @section('content')
 <div class="container">
   @include('flash::message')
   <h1 class="col-lg-12 well" >Despesas Cadastradas <i class="fa fa-file-text doc" aria-hidden="true"></i></h1>
   <!-- <a href="{{ URL::to('colaborador/verify') }}" class="btn btn-md btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Cadastrar</a> -->
   <br>
   <a href="{{ URL::to('/despesa/' . $idProcesso. '/create') }}" class="btn btn-lg btn-success"> <i class="fa fa-plus-square" aria-hidden="true"></i></a> 
   <br>
   <br>
   <table class="table table-striped table-bordered text-center tblCadastro" >
    <thead>
        <tr>
           <th>Valor</th>
           <th>Data</th>
           <th>Descrição</th>
           <th>Ação</th>
       </tr>
   </thead>
   <tbody>
    @if (!$despesa->isEmpty())
    @foreach($despesa as $key => $value)
    <tr>
        <td>R$ {!! $value->valor !!}</td>
        <td>{!! date('d/m/Y', strtotime($value->dt_despesa)) !!}</td>
        <td>{!! $value->desc_despesa !!}</td>
        <td>
        <a href="{{ URL::to('/despesa/' . $value->id_despesa . '/edit') }}" class="btn btn-lg btn-info"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> &nbsp;&nbsp;
        <a href="{{ URL::to('/despesa/' . $value->id_despesa . '/remove') }}" class="btn btn-lg btn-danger"> <i class="fa fa-trash" aria-hidden="true"></i></a> 
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
<a href="{{ URL::to('/despesa/' . $idProcesso. '/create') }}" class="btn btn-lg btn-success"> <i class="fa fa-plus-square" aria-hidden="true"></i></a>
</div>
<br>
@endsection

@section('content_js')
<script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
@endsection


