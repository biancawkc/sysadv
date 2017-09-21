 @extends('layouts.master2')
 @section('content')
 <div class="container">
 @include('flash::message')
    <h1 class="col-lg-12 well" >Todos os Funcionários Cadastrados <i class="fa fa-address-book registros" aria-hidden="true"></i></h1>
    <!-- <a href="{{ URL::to('colaborador/verify') }}" class="btn btn-md btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Cadastrar</a> -->
    <br>
    <br>
     <table class="table table-striped table-bordered tblCadastro" >
        <thead>
            <tr>
             <th>ID</th>
             <th>Nome Completo</th>
             <th>CPF</th>
             <th>Ações</th>
         </tr>
     </thead>
     <tbody>
        @if (!$funcionarios->isEmpty())
        @foreach($funcionarios as $key => $value)
        <tr>
            <td>{!! $value->id_funcionario !!}</td>
            <td>{!! $value->nome !!}</td>
            <td class="cpf">{!!  $value->cpf  !!}</td>
            <td>
                <a href="{{ URL::to('/funcionario/' . $value->id_funcionario. '/show') }}" target="_blank" class="btn btn-lg btn-success"> <i class="fa fa-info-circle fa-1x" aria-hidden="true"></i></a>       
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


