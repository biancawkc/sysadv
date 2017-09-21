 @extends('layouts.master2')
 @section('content')
 <div class="container">
   @include('flash::message')
   <h1 class="col-lg-12 well" >Despesas Cadastradas <i class="fa fa-shopping-basket despesa" aria-hidden="true"></i></h1>
   <!-- <a href="{{ URL::to('colaborador/verify') }}" class="btn btn-md btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Cadastrar</a> -->
   <br>
   <h2><b>Processo: <a href="{{URL::to('/processo/'.$idProcesso.'/show')}}">{{$processo}}</a> </b></h2>
   <br>
   <!-- <a href="{{ URL::to('/despesa/' . $idProcesso. '/create') }}" class="btn btn-lg btn-success"> <i class="fa fa-plus-square" aria-hidden="true"></i></a>  -->
   <a class="btn btn-success btn-lg" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus-square" aria-hidden="true"></i></a> 
   <br>
   <br>
   <table class="table table-striped table-bordered text-center tblCadastro" >
    <thead>
      <tr>
       <th>Valor</th>
       <th>Data</th>
       <th>Descrição</th>
       <th>Ação</th>
     </tr>
   </thead>
   <tbody>
    @if (!$despesa->isEmpty())
    @foreach($despesa as $key => $value)
    <tr>
      <td>R$ {!! $value->valor !!}</td>
      <td>{!! date('d/m/Y', strtotime($value->dt_despesa)) !!}</td>
      <td>{!! $value->desc_despesa !!}</td>
      <td>
        <a href="{{ URL::to('/despesa/' . $value->id_despesa . '/edit') }}" class="btn btn-lg btn-primary"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> &nbsp;&nbsp;
        <a href="{{ URL::to('/despesa/' . $value->id_despesa . '/remove') }}" class="btn btn-lg btn-danger"> <i class="fa fa-trash" aria-hidden="true"></i></a> 
      </td>
    </tr>
    @endforeach
    @endif
  </tbody>
</table>
<br>
<!-- <a href="{{ URL::to('/despesa/' . $idProcesso. '/create') }}" class="btn btn-lg btn-success"> <i class="fa fa-plus-square" aria-hidden="true"></i></a> -->
<a class="btn btn-success btn-lg" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus-square" aria-hidden="true"></i></a> 

<div class="modal fade" id="addModal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <!-- <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> -->
        <div class="modal-body add-modal-body">
          {!! Form::open(['route'=>['despesa.store', $idProcesso], 'method'=>'post']) !!}
          @include('flash::message')
          <div class="container-custom">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <h1 class="col-lg-12 well "> Cadastro de Despesa <i class="fa fa-shopping-basket" aria-hidden="true"></i>
            </h1>

            <div class="col-lg-12 well">
              <div class="row">
                <div class="col-sm-12">
                  <div class="row">
                    <div class="col-sm-3 form-group">
                      <label>Valor<span class="asterisk">*</span></label>
                      <input name="valor" type="text" class="form-control" data-validation="number" data-validation-allowing="float" onkeyup="this.value = this.value.replace(/,/g, '.')">   
                    </div>
                    <div class="col-sm-5 form-group">
                      <label>Data<span class="asterisk">*</span></label>
                      <div class="input-group add-on col-md-12" >
                        <div class="input-group-btn">
                          <a class="btn btn-default"><i class="fa fa-calendar"></i></a>
                        </div>
                        <input name="dt_despesa" type="text" class="form-control  datepicker date" data-validation="date" data-validation-format="dd/mm/yyyy" placeholder="dd/mm/aaaa">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Descrição<span class="asterisk">*</span></label>
                    <textarea class="form-control" rows="4" name="desc_despesa"  rows="4"></textarea>
                  </div>

                </div>
              </div>
            </div>
            <div class="form-group">
              <p><b><span class="asterisk">*</span>Campos de Preenchimento Obrigatórios </b><br><br></p>
            </div>

            <div class="text-center">
              <a data-dismiss="modal" class="btn btn-lg btn-danger">Voltar <i class="fa fa-undo" aria-hidden="true"></i></a>
              &nbsp;&nbsp;&nbsp;
              <button type="submit" class="btn btn-lg btn-info">Cadastrar <i class="fa fa-plus" aria-hidden="true"></i></button>
            </div>
            <br>
            <br>
          </div> 
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
<br>
@endsection

@section('content_js')

@endsection


