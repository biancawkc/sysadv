 @extends('layouts.master2')
 @section('content')
 <div class="container-custom">
    <h1 class="col-lg-12 well "> Cadastro de Parte  <i class="fa fa-user-plus user-plus" aria-hidden="true"></i>
     <span class="questionMark pull-right"><i class="fa fa-question-circle help" aria-hidden="true"></i></span></h1>
    <div class="col-lg-12">
    <div class="row" >
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <br>
                    <label  class="radio-inline">
                        <input type="radio" name="tp_colab" id="fis" value="Advogado">Pessoa Física
                    </label>


                    <label class="radio-inline">
                        <input type="radio" name="tp_colab" id="jur" value="Funcionário">Pessoa Jurídica 
                    </label>

                       <!--  <label class="radio-inline">
                            <input type="radio" name="tp_colab" id="men" value="outro">Outro Documento
                        </label> -->
                        <br>
                        <br>
                        <label for="msg" class="errorMsg red tex-center" id="errorMsg">{{ $msg }}</label>
                        <br>

                        
                        <div class="form-group" id="cpf-form" style="display: none;">
                            {!! Form::open(['route'=>'fisica.addPerson' , 'class'=>'form-horizontal form', 'autocomplete'=>'off']) !!}
                            <label  class="col-md-1 control-label">CPF<span class="asterisk">*</span></label>
                            <div class="col-md-7 form-inline">
                                <ul class="button-inline">
                               <li><input type="text" class="form-control cpf" name="cpf" id="cpf" data-validation="cpf" /></li>
                                <li class="second-li"><button name="submit" class="btn btn-md btn-info">Próximo</button></li> 
                                </ul>
                            </div>
                            {!! Form::close() !!}
                        </div>
                        

                        <div class="form-group" id="cnpj-form" style="display: none;">
                            {!! Form::open(['route'=>'jurid.addPerson' , 'class'=>'form-horizontal form', 'name'=>'form1', 'autocomplete'=>'off']) !!}
                            <label  class="col-md-1 control-label">CNPJ<span class="asterisk">*</span></label>
                            <div class="col-md-11 form-inline">
                                <input type="text" class="form-control cnpj" name="cnpjs" id="cnpj" onkeyup="ValidarCNPJ(form1.cnpj);" onblur="msg();" /> 
                                <a class="btn btn-md btn-info" id="prox1" onclick="erro();">Próximo</a>
                                <button name="submit" class="btn btn-md btn-info" id="prox" style="display: none;">Próximo</button>
                                <span id="submit"></span>
                                <span id="erro_cnpj"></span>
                            </div>
                            {!! Form::close() !!}
                        </div>

                    <!--     <div class="form-group" id="p-form" style="display: none;">
                        <label class="col-md-2 control-label">Documento<span class="asterisk">*</span></label>
                       <div class="col-md-4">
                                <select class="form-control" name="doc" id="doc">
                                    <option value="sel">Selecione</option>
                                    <option value="rg">RG</option>
                                    <option value="rne">RNE</option>
                                    <option value="pass">Passaporte</option>
                                </select>     
                 
                        </div>
                        <br>
                        <br>
                        <br>
                        {!! Form::open(['route'=>'fisica.addPerson' , 'class'=>'form-horizontal form']) !!}
                        <div id="rg-form" style="display: none;">
                            <label  class="col-md-1 control-label">RG<span class="asterisk">*</span></label>
                            <div class="col-md-8 form-inline">
                                <input type="text" class="form-control rg" name="rg" data-validation="required" />
                                <button name="submit" class="btn btn-md btn-info">Próximo</button> 
                            </div>
                        </div>
                        {!! Form::close() !!}

                        {!! Form::open(['route'=>'fisica.addPerson' , 'class'=>'form-horizontal form']) !!}
                        <div id="rne-form" style="display: none;">
                            <label  class="col-md-1 control-label">RNE<span class="asterisk">*</span></label>
                            <div class="col-md-8 form-inline">
                                <input type="text" class="form-control" name="rne" data-validation="required" />
                                <button name="submit" class="btn btn-md btn-info">Próximo</button> 
                            </div>
                        </div>
                        {!! Form::close() !!}

                        {!! Form::open(['route'=>'fisica.addPerson' , 'class'=>'form-horizontal form']) !!}
                         <div id="pass-form" style="display: none;">
                            <label  class="col-md-2 control-label">Passaporte<span class="asterisk">*</span></label>
                            <div class="col-md-8 form-inline">
                                <input type="text" class="form-control" name="passaporte"  data-validation="required" />
                                <button name="submit" class="btn btn-md btn-info">Próximo</button> 
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<div class="modal fade helps" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title"><i class="fa fa-info-circle info" aria-hidden="true"></i> Informação</h3>
        </div>
        <div class="modal-body">
          <p><b>CPF</b>: insira um CPF válido com 11 dígitos, somente números, não é necessário a pontuação.<br><br>
             <b>CNPJ</b>: insira um CNPJ válido com 14 dígitos, somente números, não é necessário a pontuação.
          </p>
        </div>
      </div>  
    </div>
  </div>
@endsection


@section('content_js')
<script src="{{asset('../resources/assets/js/actions/verify_parte.js')}}" type="text/javascript"></script>
@endsection


