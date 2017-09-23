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
       <td colspan="3">{{$advogado->nome}}</td>
     </tr>

     <tr>
       <th>RG</th>
       <td class="rg">{{$advogado->rg}}</td>
       <th class="col-md-3"> Órg. Emiss.</th>
       <td>{{$advogado->orgao_exp}}</td>
     </tr>

     <tr>
       <th>CPF</th>
       <td class="cpf">{{$advogado->cpf}}</td>
       <th>Estado Civil</th>
       <td>{{$civil->desc_estado_civil}}</td>
     </tr>

     <tr>
       <th>Data de nascimento</th>
       <td colspan="3">{{date('d/m/Y', strtotime($advogado->dt_nasc))}}</td>
     </tr>

     <tr>
       <th>OAB</th>
       <td style="width: 52%">{{$advogado->oab}}</td>
       <th>Seccional</th>
       <td>{{$advogado->seccional}}</td>
     </tr>
   </tbody>

 </table>

 <div class="text-center">
  
  <a href="{{ URL::to('/advogado/' . $advogado->id_advogado . '/remove') }}" class="btn btn-lg btn-danger">Deletar <i class="fa fa-trash" aria-hidden="true"></i></a>&nbsp;&nbsp;

  <a href="{{ URL::to('/advogado/' . $advogado->id_advogado. '/edit') }}" class="btn btn-lg btn-info">Editar <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;
</div>
</div>


</div>
<br>
@endsection
@section('content_js')

@endsection



