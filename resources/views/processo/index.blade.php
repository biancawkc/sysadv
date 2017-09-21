 @extends('layouts.master2')
 @section('content')
 <div class="container">
 @include('flash::message')
    <h1 class="col-lg-12 well" >Todos os Processos Cadastrados <i class="fa fa-file processo" aria-hidden="true"></i></h1>
    <!-- <a href="{{ URL::to('colaborador/verify') }}" class="btn btn-md btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Cadastrar</a> -->
    <br>
    <br>
     <table class="table table-striped table-bordered tblCadastro" >
        <thead>
            <tr>
             <!-- <th>ID</th> -->
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
            <!-- <td>{!! $value->id_processo !!}</td> -->
            <td>{!! $value->numero !!}</td>
            <td>{!! date('d/m/Y', strtotime($value->dt_inicio)) !!}</td>
            <td>{!! $value->desc_est_processo !!}</td>
            <td class="text-center"> 
                <a target="_blank" href="{{ URL::to('/processo/' . $value->id_processo . '/show') }}" class="btn btn-lg btn-primary" data-toggle="tooltip" data-placement="top" title="Detalhes"> <i class="fa fa-info-circle" aria-hidden="true"></i></a> &nbsp;&nbsp;   
                <a target="_blank" href="{{ URL::to('/etapa/' . $value->id_processo) }}" class="btn btn-lg btn-primary" data-toggle="tooltip" data-placement="top" title="Etapas"> <i class="fa fa-calendar" aria-hidden="true"></i> </a>&nbsp;&nbsp;   
                <a target="_blank" href="{{ URL::to('/documento/' . $value->id_processo) }}" class="btn btn-lg btn-primary" data-toggle="tooltip" data-placement="top" title="Documentos"> <i class="fa fa-file-text fa-1x" aria-hidden="true"></i></a>&nbsp;&nbsp; 
                <a target="_blank" href="{{ URL::to('/parcela/' . $value->id_processo) }}" class="btn btn-lg btn-primary" data-toggle="tooltip" data-placement="top" title="Parcelas"><i class="fa fa-money" aria-hidden="true"></i>
                </a>&nbsp;&nbsp; 
                <a target="_blank" href="{{ URL::to('/despesa/' . $value->id_processo) }}" class="btn btn-lg btn-primary" data-toggle="tooltip" data-placement="top" title="Despesas"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a> 
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>

</div>
<br>
@endsection

@section('content_js')
@endsection


