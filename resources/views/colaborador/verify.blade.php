 @extends('layouts.master2')
 @section('content')
     <div class="container-custom">
        <h1 class="col-lg-12 well "> Cadastro de Colaborador <i class="fa fa-user-plus user-plus" aria-hidden="true"></i>
        <span class="questionMark pull-right"><i class="fa fa-question-circle help" aria-hidden="true"></i></span>
        </h1>
        <div class="col-lg-12">
        <div class="row" >
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4>Qual o tipo de colaborador?</h4>
                        <label  class="radio-inline">
                            <input type="radio" name="tp_colab" id="adv" value="Advogado">Advogado
                        </label>

                        <label class="radio-inline">
                            <input type="radio" name="tp_colab" id="func" value="Funcionário">Funcionário 
                        </label>
                        <br>
                        <label for="msg" class="errorMsg">{{ $msg }}</label>
                        <br>
                        <div class="form-group" id="cpf-form1" style="display: none;">
                            {!! Form::open(['route'=>'advogado.addColab' , 'class'=>'form-horizontal cpfForm', 'autocomplete'=>'off']) !!}
                            <label  class="col-md-1 control-label">CPF<span class="asterisk">*</span></label>
                            <div class="col-md-7 form-inline">
                                <ul class="button-inline">
                                <li><input type="text" class="form-control cpf" name="cpf" data-validation="cpf"/></li>
                                <li class="second-li"><button name="submit" class="btn btn-md btn-info">Próximo</button></li> 
                                </ul>
                            </div>
                             {!! Form::close() !!}
                        </div>
                       
                        <div class="form-group" id="cpf-form2" style="display: none;">
                            {!! Form::open(['route'=>'funcionario.addColab' , 'class'=>'form-horizontal cpfForm', 'autocomplete'=>'off']) !!}
                            <label  class="col-md-1 control-label">CPF<span class="asterisk">*</span></label>
                            <div class="col-md-7 form-inline">
                                <ul class="button-inline">
                                <li><input type="text" class="form-control cpf" name="cpf" data-validation="cpf"/></li>
                                <li class="second-li"><button name="submit" class="btn btn-md btn-info">Próximo</button></li>
                                </ul>
                            </div>
                            {!! Form::close() !!}
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
          </p>
        </div>
      </div>  
    </div>
  </div>

</div> 

@endsection


@section('content_js')
<script type="text/javascript" >

    $(document).ready(function() {
   $('input[type="radio"]').click(function() {
       if($(this).attr('id') == 'adv') {
            $('#cpf-form1').show();  
            $('#cpf-form2').hide();          
       }

       else {
            $('#cpf-form1').hide();
            $('#cpf-form2').show();  
       }
   });

   $(".cpfForm").submit(function() {
        $(".cpf").unmask();
    });
});

</script>
@endsection


