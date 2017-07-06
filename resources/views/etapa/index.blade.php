 @extends('layouts.master2')
 @section('content')
 <div class="container">
   @include('flash::message')
   <h1 class="col-lg-12 well" >Etapas Cadastradas <i class="fa fa-calendar etapa" aria-hidden="true"></i></h1>
   <!-- <a href="{{ URL::to('colaborador/verify') }}" class="btn btn-md btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Cadastrar</a> -->
   <br>
   <a href="{{ URL::to('/etapa/' . $idProcesso. '/create') }}" class="btn btn-lg btn-success"> <i class="fa fa-calendar-plus-o fa-1x" aria-hidden="true"></i></a> 
   <br>
   <br>
   <table id="tblCadastro" class="table table-striped table-bordered text-center" >
    <thead>
        <tr>
           <th>ID</th>
           <th>Nome</th>
           <th>Data Início</th>
           <th>Data Final</th>
           <th>Ações</th>
       </tr>
   </thead>
   <tbody>
    @if (!$etapas->isEmpty())
    @foreach($etapas as $key => $value)
    <tr>
        <td>{!! $value->id_etapa_processo !!}</td>
        <td>{!! $value->nome !!}</td>
        <td>{!! $value->dt_etapa !!}</td>
        <td>{!! $value->dt_prazo !!}</td>
        <td>
            <a href="" class="btn btn-lg btn-info"> <i class="fa fa-info-circle" aria-hidden="true"></i></a>    
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
<a href="{{ URL::to('/etapa/' . $idProcesso. '/create') }}" class="btn btn-lg btn-success"> <i class="fa fa-calendar-plus-o fa-1x" aria-hidden="true"></i></a> 

</div>
<br>
@endsection

@section('content_js')
<script>
    $("#tblCadastro").dataTable({
      "language": {
          "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese.json"
      }
  });
    
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
@endsection


