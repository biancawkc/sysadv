 @extends('layouts.master2')
 @section('content')
 <div class="container">
 @include('flash::message')
    <h1 class="col-lg-12 well" >Todos os Processos Cadastrados <i class="fa fa-file processo" aria-hidden="true"></i></h1>
    <!-- <a href="{{ URL::to('colaborador/verify') }}" class="btn btn-md btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Cadastrar</a> -->
    <br>
    <br>
     <table id="tblCadastro" class="table table-striped table-bordered text-center" >
        <thead>
            <tr>
             <th>ID</th>
             <th>Número</th>
             <th>Data Início</th>
             <th>Status</th>
             <th>Ações</th>
         </tr>
     </thead>
     <tbody>
        @if (!$processos->isEmpty())
        @foreach($processos as $key => $value)
        <tr>
            <td>{!! $value->id_processo !!}</td>
            <td>{!! $value->numero !!}</td>
            <td>{!! $value->dt_inicio  !!}</td>
            <td>{!! $value->id_estado_processo  !!}</td>
            <td>
                <a href="" class="btn btn-lg btn-success" data-toggle="tooltip" data-placement="top" title="Detalhes"> <i class="fa fa-info-circle" aria-hidden="true"></i></a> &nbsp;&nbsp;   
                <a href="{{ URL::to('/etapa/' . $value->id_processo) }}" class="btn btn-lg btn-info" data-toggle="tooltip" data-placement="top" title="Etapas"> <i class="fa fa-calendar" aria-hidden="true"></i> </a>&nbsp;&nbsp;   
                <a href="{{ URL::to('/documento/' . $value->id_processo) }}" class="btn btn-lg btn-warning" data-toggle="tooltip" data-placement="top" title="Documentos"> <i class="fa fa-file-text fa-1x" aria-hidden="true"></i></a>    
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


