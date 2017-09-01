 @extends('layouts.master2')
 @section('content')
 <div class="container">
   @include('flash::message')
   <h1 class="col-lg-12 well" >Etapas Cadastradas <i class="fa fa-calendar-check-o etapa" aria-hidden="true"></i></h1>
   <!-- <a href="{{ URL::to('colaborador/verify') }}" class="btn btn-md btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Cadastrar</a> -->
   <br>
   <a href="{{ URL::to('/etapa/' . $idProcesso. '/create') }}" class="btn btn-lg btn-success"> <i class="fa fa-calendar-plus-o fa-1x" aria-hidden="true"></i></a> 
   <br>
   <br>
   <table class="table table-striped table-bordered text-center tblCadastro " >
    <thead>
        <tr>
           <!-- <th>ID</th> -->
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
        <!-- <td>{!! $value->id_etapa_processo !!}</td> -->
        <td>{!! $value->nome !!}</td>
        <td>{!! date('d/m/Y', strtotime($value->dt_etapa)) !!}</td>
        <td>{!! date('d/m/Y', strtotime($value->dt_prazo)) !!}</td>
        <td>
            <a href="{{ URL::to('/etapa/' . $value->id_etapa_processo . '/show') }}" class="btn btn-lg btn-info"> <i class="fa fa-info-circle" aria-hidden="true"></i></a>    
        </td>
    </tr>
    @endforeach
    @else
    <td colspan="4">
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
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
@endsection


