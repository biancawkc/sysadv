 @extends('layouts.master2')
 @section('content')
 <div class="container">
 @include('flash::message')
    <h1 class="col-lg-12 well" >Todos os Usuários Cadastrados <i class="fa fa-user-circle registros" aria-hidden="true"></i></h1>
    <!-- <a href="{{ URL::to('colaborador/verify') }}" class="btn btn-md btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Cadastrar</a> -->
    <br>
    <br>
    <div class="table-responsive-force">
     <table class="table table-striped table-bordered tblCadastro" id="tblCadastro">
        <thead>
            <tr>
             <th class="col-md-3">Nome Completo</th>
             <th class="col-md-2">Usuário</th>
             <th class="col-md-3">Email</th>
             <th class="col-md-1">Situação</th>
             <th class="col-md-2">Nível</th>
             <th>Ação</th>
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
            <td><a href="{{ URL::to('/usuarioFunc/' . $value->id_usuario. '/edit') }}" class="btn btn-lg btn-primary" data-toggle="tooltip" data-placement="top" title="Editar"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
            
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
            <td><a href="{{ URL::to('/usuarioAdv/' . $value->id_usuario. '/edit') }}" class="btn btn-lg btn-primary" data-toggle="tooltip" data-placement="top" title="Editar"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
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
<script type="text/javascript">
   
</script>
@endsection


