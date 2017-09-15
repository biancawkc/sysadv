 @extends('layouts.master2')
 @section('content')
 <div class="container-custom">
   @include('flash::message')
   <br>
   <table class="table table-striped table-bordered" style="width: 700px;">
    <tbody>
     <tr>
       <th class="col-md-4">Razão Social</th>
       <td>{{$pessoaJuridica->razao_social}}</td>
     </tr>

     <tr>
       <th>Nome Fantasia</th>
       <td>{{$pessoaJuridica->nm_fantasia}}</td>
     </tr>

     <tr>
       <th>Inscrição Estadual</th>
       <td>{{$pessoaJuridica->ins_estadual}}</td>
     </tr>

     <tr>
       <th>Descrição de Atividades</th>
       <td>{{$pessoaJuridica->desc_atividades}}</td>
     </tr>

  </tbody>

</table>

<table class="table table-striped table-bordered" style="width: 700px;">
  <tr>
    <th class="col-md-4">Email</th>
    <td>{{$parte->email}}</td>
  </tr>

  @foreach($telefone as $tel)
   <tr>
    <th>Telefone {{$tel->tp_telefone}}</th>
    <td class="phone_with_ddd">{{$tel->telefone}}</td>
    </tr>
    @endforeach
</table>

<table class="table table-striped table-bordered" style="width: 700px;">
  <tr>
    <th style="width: 18%">CEP</th>
    <td>{{$endereco->cep}}</td>
    <th>Bairro</th>
    <td>{{$endereco->bairro}}</td>
  </tr>

  <tr>
    <th>Cidade</th>
    <td>{{$endereco->cidade}}</td>
    <th style="width: 18%">UF</th>
    <td>{{$endereco->uf}}</td>
  </tr>

  <tr>
    <th >Logradouro</th>
    <td>{{$endereco->logradouro}}</td>
    <th>Número</th>
    <td>{{$endereco->numero}}</td>
  </tr>
  <tr>
    <th colspan="1">Complemento</th>
    <td colspan="3">{{$endereco->complemento}}</td>
  </tr>
</table>
<div class="text-center">
@if (Auth::guard('web_usuario')->user()->administrador)
  <a href="{{ URL::to('/pessoaJuridica/' . $pessoaJuridica->id_parte . '/remove') }}" class="btn btn-lg btn-danger">Deletar <i class="fa fa-trash" aria-hidden="true"></i></a>&nbsp;&nbsp;
@endif
  <a href="{{ URL::to('/pessoaJuridica/' . $pessoaJuridica->id_parte. '/edit') }}" class="btn btn-lg btn-info">Editar <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;
</div>
</div>


</div>
<br>
@endsection




