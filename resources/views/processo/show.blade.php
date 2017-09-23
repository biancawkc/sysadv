 @extends('layouts.master2')
 @section('content')
 <div class="container-custom">
   @include('flash::message')
   <h1><b>Processo: {{$processo->numero}} </b></h1>
   <h4><b>Estado</b>: {{$estadoProcesso->desc_est_processo}}</h4>
   <table class="table table-striped table-bordered" style="width: 700px;">
    <tbody>
     <tr>
       <th class="col-md-3">Nome da ação</th>
       <td colspan="3">{{$processo->nome_acao}}</td>
     </tr>

     <tr>
       <th>Justiça gratuita</th>
       @if($processo->justica_grat == "1")
       <td class="col-md-3">Sim</td>
       @else
       <td class="col-md-3">Não</td>
       @endif
       <th class="col-md-3">Ação gratuita </th>
       @if($processo->acao_grat == "1")
       <td>Sim</td>
       @else
       <td>Não</td>
       @endif
     </tr>

     <tr>
       <th>Data de início</th>
       <td>{{ date('d/m/Y', strtotime($processo->dt_inicio))}} </td>
       <th class="col-md-3">Data final</th>
        @if(!is_null($processo->dt_final))
       <td>{{ date('d/m/Y', strtotime($processo->dt_final))}}</td>
       @else
       <td></td>
       @endif
     </tr>

     <tr>
       <th>Justiça</th>
       <td colspan="3">{{$justica->nm_justica}}</td>
     </tr>

     <tr>
       <th>Comarca</th>
       <td colspan="3">{{$comarca->comarca}}</td>
     </tr>

     <tr>
       <th>Vara</th>
       <td colspan="3">{{$vara->vara}}</td>
     </tr>

     <tr>
      <th>Descrição</th>
      <td colspan="3">{{$processo->desc_processo}}</td>
    </tr>

  </tbody>

</table>
<h3>Cliente(s)</h3>
@if (!is_null($pessoaJuridicaC))
@foreach($pessoaJuridicaC as $value)
<table class="table table-striped table-bordered" style="width: 700px;">
  <tbody>
   <tr>
    <td colspan="4" class="text-center col-md-10">{{$value -> razao_social}}</td>
    <td class="text-center"><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#{{$value->id_parte}}"><i class="fa fa-search-plus" aria-hidden="true"></i></button></td>
  </tr>
</tbody>
</table>
<div class="modal fade" id="{{$value->id_parte}}" role="dialog">
  <div class="modal-dialog custom-modal">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Cliente: {{$value -> razao_social}}</h4>
      </div>
      <div class="modal-body">

        <table class="table table-striped table-bordered">
          <tbody>
           <tr>
             <th class="col-md-4">Nome fantasia</th>
             <td>{{$value->nm_fantasia}}</td>
           </tr>
           <tr>
            <th>CNPJ</th>
            <td class="cnpj">{{$value->cnpj}}</td>
          </tr>
          <tr>
            <th>Inscrição estadual</th>
            <td>{{$value->ins_estadual}}</td>
          </tr>
          <tr>
           <th>Descrição de Atividades</th>
           <td>{{$value->desc_atividades}}</td>
         </tr>
       </tbody>
     </table>
     <table class="table table-striped table-bordered">
      <tr>
        <th class="col-md-4">Email</th>
        <td>{{$value->email}}</td>
      </tr>

      <tr>
        <th>Telefone</th>
        <td>{{$value->telefones}}</td>
      </tr>
    </table>

    <table class="table table-striped table-bordered">
      <tr>
        <th style="width: 20%">CEP</th>
        <td class="cep">{{$value->cep}}</td>
        <th>Bairro</th>
        <td>{{$value->bairro}}</td>
      </tr>

      <tr>
        <th>Cidade</th>
        <td>{{$value->cidade}}</td>
        <th style="width: 15%">UF</th>
        <td>{{$value->uf}}</td>
      </tr>

      <tr>
        <th >Logradouro</th>
        <td style="width: 50%>{{$value->logradouro}}</td>
        <th>Número</th>
        <td>{{$value->numero}}</td>
      </tr>
      <tr>
        <th colspan="1">Complemento</th>
        <td colspan="3">{{$value->complemento}}</td>
      </tr>
    </table>
  </div>
  <div class="modal-footer">
  <a href="{{ URL::to('/pessoaJuridica/' . $value->id_parte . '/show')}}" class="btn btn-success" target="_blank">Mais <i class="fa fa-search" aria-hidden="true"></i></a>
    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar <i class="fa fa-times" aria-hidden="true"></i></button>
  </div>

</div>
</div>
</div>
@endforeach
@endif
@if(!is_null($pessoaFisicaC)) 
@foreach($pessoaFisicaC as $k => $values)
<table class="table table-striped table-bordered" style="width: 700px;">
  <tbody>
    <tr>
      <!-- <th class="col-md-3">Nome</th> -->
      <td colspan="4" class="text-center col-md-10">{{$values -> nome}}</td>
      <td class="text-center"><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#{{$values->id_parte}}"><i class="fa fa-search-plus" aria-hidden="true"></i></button></td>
    </tr>
  </tbody>
</table>
<div class="modal fade" id="{{$values->id_parte}}" role="dialog">
  <div class="modal-dialog custom-modal">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Cliente: {{$values -> nome}}</h4>
      </div>
      <div class="modal-body">
        <table class="table table-striped table-bordered">
         <tbody>
          <tr>
            <th style="width: 20%">RG</th>
            <td class="rg">{{$values -> rg}}</td>
            <th style="width: 20%">Orgão Exp.</th>
            <td>{{$values -> orgao_exp}}</td>
          </tr>
          <tr>
            <th>CPF</th>
            <td class="cpf">{{$values -> cpf}}</td>
            <th>Estado civil</th>
            <td>{{$values -> estados}}</td>
          </tr>
          <tr>
            <th>Data Nasc.</th>
            <td colspan="3">{{ date('d/m/Y', strtotime($values->dt_nasc)) }}</td>
          </tr>
        </tbody>
      </table>
      <table class="table table-striped table-bordered">
        <tr>
          <th class="col-md-4">Email</th>
          <td>{{$values->email}}</td>
        </tr>

        <tr>
          <th>Telefone(s)</th>
          <td>{{$values->telefones}}</td>
        </tr>
      </table>
      <table class="table table-striped table-bordered">
       <tbody>
        <tr>
          <th style="width: 20%">CTPS</th>
          <td colspan="3">{{$values -> ctps}}</td>
        </tr>
        <tr>
          <th>CBO</th>
          <td>{{$values->cbo}}</td>
          <th style="width: 20%">Remuneração</th>
          <td></td>
        </tr>
        <tr>
          <th>Profissão</th>
          <td colspan="3">{{$values->profis}}</td>
        </tr>
      </tbody>
    </table>
    <table class="table table-striped table-bordered">
     <tbody>
      <th style="width: 20%">CEP</th>
      <td class="cep">{{$values->cep}}</td>
      <th>Bairro</th>
      <td>{{$values->bairro}}</td>
    </tr>

    <tr>
      <th>Cidade</th>
      <td>{{$values->cidade}}</td>
      <th style="width: 15%">UF</th>
      <td>{{$values->uf}}</td>
    </tr>

    <tr>
      <th >Logradouro</th>
      <td style="width: 50%">{{$values->logradouro}}</td>
      <th>Número</th>
      <td>{{$values->numero}}</td>
    </tr>
    <tr>
      <th colspan="1">Complemento</th>
      <td colspan="3">{{$values->complemento}}</td>
    </tr>
  </tbody>
</table>
</div>
<div class="modal-footer">
  <a href="{{ URL::to('/pessoaFisica/' . $values->id_parte . '/show')}}" class="btn btn-success" target="_blank">Mais <i class="fa fa-search" aria-hidden="true"></i></a>
  <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar <i class="fa fa-times" aria-hidden="true"></i></button>
</div>
</div>
</div>
</div>
@endforeach
@endif
<h3>Parte(s) Adversa(s)</h3>
@if (!is_null($pessoaJuridicaA))
@foreach($pessoaJuridicaA as $value)
<table class="table table-striped table-bordered" style="width: 700px;">
  <tbody>
   <tr>
    <td colspan="4" class="text-center col-md-10">{{$value -> razao_social}}</td>
    <td class="text-center"><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#{{$value->id_parte}}"><i class="fa fa-search-plus" aria-hidden="true"></i></button></td>
  </tr>
</tbody>
</table>
<div class="modal fade" id="{{$value->id_parte}}" role="dialog">
  <div class="modal-dialog custom-modal">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Parte Adversa: {{$value -> razao_social}}</h4>
      </div>
      <div class="modal-body">

        <table class="table table-striped table-bordered">
          <tbody>
           <tr>
             <th class="col-md-4">Nome fantasia</th>
             <td>{{$value->nm_fantasia}}</td>
           </tr>
           <tr>
            <th>CNPJ</th>
            <td class="cnpj">{{$value->cnpj}}</td>
          </tr>
          <tr>
            <th>Inscrição estadual</th>
            <td>{{$value->ins_estadual}}</td>
          </tr>
          <tr>
           <th>Descrição de Atividades</th>
           <td>{{$value->desc_atividades}}</td>
         </tr>
       </tbody>
     </table>
     <table class="table table-striped table-bordered">
      <tr>
        <th class="col-md-4">Email</th>
        <td>{{$value->email}}</td>
      </tr>

      <tr>
        <th>Telefone</th>
        <td>{{$value->telefones}}</td>
      </tr>
    </table>

    <table class="table table-striped table-bordered">
      <tr>
        <th style="width: 20%">CEP</th>
        <td class="cep">{{$value->cep}}</td>
        <th>Bairro</th>
        <td>{{$value->bairro}}</td>
      </tr>

      <tr>
        <th>Cidade</th>
        <td>{{$value->cidade}}</td>
        <th style="width: 15%">UF</th>
        <td>{{$value->uf}}</td>
      </tr>

      <tr>
        <th>Logradouro</th>
        <td style="width: 50%">{{$value->logradouro}}</td>
        <th>Número</th>
        <td>{{$value->numero}}</td>
      </tr>

      <tr>
        <th colspan="1">Complemento</th>
        <td colspan="3">{{$value->complemento}}</td>
      </tr>
    </table>
  </div>
  <div class="modal-footer">
  <a href="{{ URL::to('/pessoaJuridica/' . $value->id_parte . '/show')}}" class="btn btn-success" target="_blank">Mais <i class="fa fa-search" aria-hidden="true"></i></a>
    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar <i class="fa fa-times" aria-hidden="true"></i></button>
  </div>

</div>
</div>
</div>
@endforeach
@endif
@if(!is_null($pessoaFisicaA)) 
@foreach($pessoaFisicaA as $key => $values)
<table class="table table-striped table-bordered" style="width: 700px;">
  <tbody>
    <tr>
      <!-- <th class="col-md-3">Nome</th> -->
      <td colspan="4" class="text-center col-md-10">{{$values -> nome}}</td>
      <td class="text-center"><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#{{$values->id_parte}}"><i class="fa fa-search-plus" aria-hidden="true"></i></button></td>
    </tr>
  </tbody>
</table>
<div class="modal fade" id="{{$values->id_parte}}" role="dialog">
  <div class="modal-dialog custom-modal">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Parte Adversa: {{$values -> nome}}</h4>
      </div>
      <div class="modal-body">
        <table class="table table-striped table-bordered">
         <tbody>
          <tr>
            <th style="width: 20%">RG</th>
            <td class="rg">{{$values -> rg}}</td>
            <th style="width: 20%">Orgão Exp.</th>
            <td>{{$values -> orgao_exp}}</td>
          </tr>
          <tr>
            <th>CPF</th>
            <td class="cpf">{{$values -> cpf}}</td>
            <th>Estado civil</th>
            <td>{{$values -> estados}}</td>
          </tr>
          <tr>
            <th>Data Nasc.</th>
            <td colspan="3">{{ date('d/m/Y', strtotime($values->dt_nasc)) }}</td>
          </tr>
        </tbody>
      </table>
      <table class="table table-striped table-bordered">
        <tr>
          <th class="col-md-4">Email</th>
          <td>{{$values->email}}</td>
        </tr>

        <tr>
          <th>Telefone(s)</th>
          <td>{{$values->telefones}}</td>
        </tr>
      </table>
      <table class="table table-striped table-bordered">
       <tbody>
        <tr>
          <th style="width: 20%">CTPS</th>
          <td colspan="3">{{$values -> ctps}}</td>
        </tr>
        <tr>
          <th>CBO</th>
          <td>{{$values->cbo}}</td>
          <th style="width: 20%">Remuneração</th>
          <td></td>
        </tr>
        <tr>
          <th>Profissão</th>
          <td colspan="3">{{$values->profis}}</td>
        </tr>
      </tbody>
    </table>
    <table class="table table-striped table-bordered">
     <tbody>
      <th style="width: 20%">CEP</th>
      <td class="cep">{{$values->cep}}</td>
      <th>Bairro</th>
      <td>{{$values->bairro}}</td>
    </tr>

    <tr>
      <th>Cidade</th>
      <td>{{$values->cidade}}</td>
      <th style="width: 15%">UF</th>
      <td>{{$values->uf}}</td>
    </tr>

    <tr>
      <th >Logradouro</th>
      <td style="width: 50%">{{$values->logradouro}}</td>
      <th>Número</th>
      <td>{{$values->numero}}</td>
    </tr>
    <tr>
      <th colspan="1">Complemento</th>
      <td colspan="3">{{$values->complemento}}</td>
    </tr>
  </tbody>
</table>
</div>
<div class="modal-footer">
  <a href="{{ URL::to('/pessoaFisica/' . $values->id_parte . '/show')}}" class="btn btn-success" target="_blank">Mais <i class="fa fa-search" aria-hidden="true"></i></a>
  <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar <i class="fa fa-times" aria-hidden="true"></i></button>
</div>
</div>
</div>
</div>
@endforeach
@endif

<p class="text-center">Data de criação: {{date('d/m/Y H:i:s', strtotime($processo->dt_criacao))}} &nbsp;&nbsp;&nbsp; Última alteração feita em {{date('d/m/Y H:i:s', strtotime($processo->dt_criacao))}} por {{$usuario->username}} </p>
<br>
<div class="text-center">
  <!-- <a href="{{ URL::to('/processo/' . $processo->id_processo . '/remove') }}" class="btn btn-lg btn-danger">Deletar <i class="fa fa-trash" aria-hidden="true"></i></a>&nbsp;&nbsp; -->
  <a href="{{ URL::to('/processo/' . $processo->id_processo. '/edit') }}" class="btn btn-lg btn-primary" data-toggle="tooltip" data-placement="top" title="Editar"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;
  <a href="{{ URL::to('/etapa/' . $processo->id_processo) }}" class="btn btn-lg btn-primary" target="_blank" data-toggle="tooltip" data-placement="top" title="Etapas"> <i class="fa fa-calendar" aria-hidden="true"></i></a>&nbsp;&nbsp;
  <a href="{{ URL::to('/documento/' . $processo->id_processo) }}" class="btn btn-lg btn-primary" data-toggle="tooltip" data-placement="top" title="Documentos"> <i class="fa fa-file-text" aria-hidden="true"></i></a>&nbsp;&nbsp;
  <a href="{{ URL::to('/relatorio/' .$processo->id_processo) }}" target="_blank" class="btn btn-lg btn-primary" data-toggle="tooltip" data-placement="top" title="Relatórios"> <i class="fa fa-files-o" aria-hidden="true"></i></a> &nbsp;&nbsp;
  <a target="_blank" href="{{ URL::to('/parcela/' . $processo->id_processo) }}" class="btn btn-lg btn-primary" data-toggle="tooltip" data-placement="top" title="Parcelas">  <i class="fa fa-money" aria-hidden="true"></i>
  </a>&nbsp;&nbsp;
  <a target="_blank" href="{{ URL::to('/despesa/' . $processo->id_processo) }}" class="btn btn-lg btn-primary" data-toggle="tooltip" data-placement="top" title="Despesas"> <i class="fa fa-shopping-basket" aria-hidden="true"></i></a> 
</div>
</div>
<br>

@endsection