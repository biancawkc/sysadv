 @extends('layouts.master2')
 @section('content')
 <div class="container">
   @include('flash::message')
   <h1 class="col-lg-12 well" >Agenda <i class="fa fa-calendar-check-o etapa" aria-hidden="true"></i></h1>
   <!-- <a href="{{ URL::to('colaborador/verify') }}" class="btn btn-md btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Cadastrar</a> -->
   <br>

   <br>
   <br>
   <div class="table-responsive-force">
   <table class="table table-striped table-bordered  tblCadastro " >
    <thead>
        <tr>
           <!-- <th>ID</th> -->
           <th class="col-md-4">Nome</th>
           <th class="col-md-2">Data Início</th>
           <th class="col-md-2">Data Final</th>
           <th class="col-md-3">Processo</th>
           <th class="col-md-2">Ações</th>
       </tr>
   </thead>
   <tbody>
    @if (!$etapas->isEmpty())
    @foreach($etapas as $key => $value)
    <tr>
        <!-- <td>{!! $value->id_etapa_processo !!}</td> -->
        <td>{!! $value->nm_etapa !!}</td>
        <td>{!! date('d/m/Y', strtotime($value->dt_etapa)) !!}</td>
        <td>{!! date('d/m/Y', strtotime($value->dt_prazo)) !!}</td>
        <td><a href="{{URL::to('/processo/' . $value->id_processo . '/show')}}" target="_blank">{!! $value->numero!!}</a></td>
        <td class="text-center">
            <a href="{{ URL::to('/etapa/' . $value->id_etapa_processo . '/show') }}" class="btn btn-lg btn-primary" data-toggle="tooltip" data-placement="top" title="Detalhes"> <i class="fa fa-info-circle" aria-hidden="true"></i></a>    
        </td>
    </tr>
    @endforeach
    @endif
</tbody>
</table>
</div>
<br>


</div>
<br>
@endsection

@section('content_js')
<script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
@endsection


