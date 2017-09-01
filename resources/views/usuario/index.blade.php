 @extends('layouts.master2')
 @section('content')
 <div class="container">
 @include('flash::message')
    <h1 class="col-lg-12 well" >Todos os Usuários Cadastrados <i class="fa fa-address-book registros" aria-hidden="true"></i></h1>
    <!-- <a href="{{ URL::to('colaborador/verify') }}" class="btn btn-md btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Cadastrar</a> -->
    <br>
    <br>
     <table class="table table-striped table-bordered text-center tblCadastro" >
        <thead>
            <tr>
             <th>Nome Completo</th>
             <th>Username</th>
             <th>Email</th>
             <th>Situação</th>
             <th>Nível</th>
            </tr>
     </thead>
     <tbody>
        @if (!$funcionarios->isEmpty())
        @foreach($funcionarios as $key => $value)
        <tr>
            <td><a href="{{ URL::to('funcionario/'.$value->id_funcionario.'/show')}}" target="_blank">{!! $value->nome !!}</a></td>
            <td>{!! $value->username !!}</td>
            <td>{!!  $value->email  !!}</td>
            @if($value->ativo == 1)
            <td>Ativo</td>
            @else
            <td>Inativo</td>
            @endif
            @if($value->administrador == 1)
            <td>Administrador</td>
            @else
            <td>Usuário Comum</td>
            @endif
            
        </tr>
        @endforeach
        @endif
        @if (!$advogados->isEmpty())
        @foreach($advogados as $key => $value)
        <tr>
            <td> <a href="{{ URL::to('advogado/'.$value->id_advogado.'/show') }}" target="_blank">{!! $value->nome !!}</a></td>
            <td>{!! $value->username !!}</td>
            <td>{!!  $value->email  !!}</td>
            @if($value->ativo == 1)
            <td>Ativo</td>
            @else
            <td>Inativo</td>
            @endif
            @if($value->administrador == 1)
            <td>Administrador</td>
            @else
            <td>Usuário Comum</td>
            @endif

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


