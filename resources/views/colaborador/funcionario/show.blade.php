 @extends('layouts.master2')
 @section('content')
 <div class="container-custom">
   @include('flash::message')
   <br>
   <br>
   <br>
   <table class="table table-striped table-bordered" style="width: 700px;">
    <tbody>
     <tr>
       <th class="col-md-3">Nome Completo</th>
       <td colspan="3">{{$funcionario->nome}}</td>
     </tr>
     
     <tr>
       <th>RG</th>
       <td class="rg">{{$funcionario->rg}}</td>
       <th class="col-md-3"> Órg. Emiss.</th>
       <td>{{$funcionario->orgao_exp}}</td>
     </tr>

     <tr>
       <th>CPF</th>
       <td class="cpf">{{$funcionario->cpf}}</td>
       <th>Estado Civil</th>
       <td>{{$civil->desc_estado_civil}}</td>
     </tr>

     <tr>
       <th>Data de nascimento</th>
       <td colspan="3">{{date('d/m/Y', strtotime($funcionario->dt_nasc))}}</td>
     </tr>

     <tr>
       <th>Data de Admissão</th>
       <td>{{date('d/m/Y', strtotime($funcionario->dt_admissao))}}</td>
       <th>Data de Demissão</th>
       <td>{{date('d/m/Y', strtotime($funcionario->dt_demissao))}}</td>
     </tr>
     <tr>
       <th>Qualificações</th>
       <td colspan="3">{{$funcionario->qualificacoes}}</td>
     </tr>
  </tbody>

</table>

<div class="text-center">
  <a href="{{ URL::to('/funcionario/' . $funcionario->id_funcionario . '/remove') }}" class="btn btn-lg btn-danger">Deletar <i class="fa fa-trash" aria-hidden="true"></i></a>&nbsp;&nbsp;
  <a href="{{ URL::to('/funcionario/' . $funcionario->id_funcionario. '/edit') }}" class="btn btn-lg btn-info">Editar <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;
</div>
</div>


</div>
<br>
@endsection




