 @extends('layouts.master2')
 @section('content')
 <div class="container">
 @include('flash::message')
    <h1 class="col-lg-12 well" >Todos os Advogados Cadastrados <i class="fa fa-address-book registros" aria-hidden="true"></i></h1>
    <!-- <a href="{{ URL::to('colaborador/verify') }}" class="btn btn-md btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Cadastrar</a> -->
    <br>
    <br>
     <table class="table table-striped table-bordered  tblCadastro" >
        <thead>
            <tr>
             <th>Nome Completo</th>
             <th>CPF</th>
             <th>Ações</th>
         </tr>
     </thead>
     <tbody>
        @if (!$advogados->isEmpty())
        @foreach($advogados as $key => $value)
        <tr>
            <td>{!! $value->nome !!}</td>
            <td class="cpf">{!!  $value->cpf  !!}</td>
            <td class="text-center">
                <a href="{{ URL::to('/advogado/' . $value->id_advogado . '/show') }}" target="_blank" class="btn btn-lg btn-success"> <i class="fa fa-info-circle fa-1x" aria-hidden="true"></i></a>    
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>
<br>
@endsection

@section('content_js')

@endsection


