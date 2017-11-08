 @extends('layouts.master2')
 @section('content')
 <div class="container">
 @include('flash::message')
    <h1 class="col-lg-12 well" > Partes <i class="fa fa-address-book registros" aria-hidden="true"></i></h1>
    <!-- <a href="{{ URL::to('colaborador/verify') }}" class="btn btn-md btn-success"><i class="fa fa-plus" aria-hidden="true"></i></a> --> 
    <br>
    <br>
    <div class="table-responsive-force">
     <table class="table table-striped table-bordered tblCadastro" >
        <thead>
            <tr>
             <!-- <th>ID</th> -->
             <th>Razão Social / Nome Completo</th>
             <th>CNPJ / CPF</th>
             <th>Ações</th>
         </tr>
     </thead>
     <tbody>
        @if (!$jurid->isEmpty())
        @foreach($jurid as $key => $value)
        <tr>
            <!-- <td>{!! $value->id_parte !!}</td> -->
            <td class="col-md-4">{!! $value->razao_social !!}</td>
            <td class="cnpj">{!! $value->cnpj!!}</td>
            <td class="text-center">
             <a target="_blank" href="{{ URL::to('/pessoaJuridica/' . $value->id_parte . '/show') }}" class="btn btn-lg btn-primary" data-toggle="tooltip" data-placement="top" title="Detalhes"> <i class="fa fa-info-circle" aria-hidden="true"></i></a> 
            </td>
        </tr>
        @endforeach
        @endif
        @if (!$fisica->isEmpty())
        @foreach($fisica as $val)
        <tr>
            <!-- <td>{!! $val->id_parte !!}</td> -->
            <td class="col-md-4">{!! $val->nome !!}</td>
            <td class="cpf col-md-4">{!! $val->cpf!!}</td>
            <td class="col-md-4 text-center">
              <a target="_blank" href="{{ URL::to('/pessoaFisica/' . $val->id_parte . '/show') }}" class="btn btn-lg btn-primary" data-toggle="tooltip" data-placement="top" title="Detalhes"> <i class="fa fa-info-circle" aria-hidden="true"></i></a>   
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


