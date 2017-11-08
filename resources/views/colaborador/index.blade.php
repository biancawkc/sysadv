 @extends('layouts.master2')
 @section('content')
 <div class="container">
 @include('flash::message')
    <h1 class="col-lg-12 well" >Todos os Colaboradores Cadastrados <i class="fa fa-address-book registros" aria-hidden="true"></i></h1>
    <!-- <a href="{{ URL::to('colaborador/verify') }}" class="btn btn-md btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Cadastrar</a> -->
    <br>
    <br>
    <div class="table-responsive-force">
     <table class="table table-striped table-bordered tblCadastro" >
        <thead>
            <tr>
             <th>Nome Completo</th>
             <th>CPF</th>
             <th class="col-md-2">Categoria</th>
             <th>Ações</th>
         </tr>
     </thead>
     <tbody>
        @if (!$funcionarios->isEmpty())
        @foreach($funcionarios as $key => $value)
        <tr>
            <td>{!! $value->nome !!}</td>
            <td class="cpf">{!!  $value->cpf  !!}</td>
            <td>Funcionário</td>
            <td class="text-center">
                <a href="{{ URL::to('/funcionario/' . $value->id_funcionario. '/show') }}" target="_blank" class="btn btn-lg btn-primary" data-toggle="tooltip" data-placement="top" title="Detalhes"> <i class="fa fa-info-circle fa-1x" aria-hidden="true"></i></a>       
            </td>
        </tr>
        @endforeach
        
        @endif

         @if (!$advogados->isEmpty())
        @foreach($advogados as $key => $value)
        <tr>
            <td>{!! $value->nome !!}</td>
            <td class="cpf">{!!  $value->cpf  !!}</td>
            <td>Advogado</td>
            <td class="text-center">
                <a href="{{ URL::to('/advogado/' . $value->id_advogado . '/show') }}" target="_blank" class="btn btn-lg btn-primary" data-toggle="tooltip" data-placement="top" title="Detalhes"> <i class="fa fa-info-circle fa-1x" aria-hidden="true"></i></a>    
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>
</div>
</div>
<br>
@endsection

@section('content_js')

@endsection


