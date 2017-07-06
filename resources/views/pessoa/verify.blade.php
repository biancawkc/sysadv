 @extends('layouts.master2')
 @section('content')
     <div class="container-custom">
        <h1 class="col-lg-12 well "> Cadastro de Pessoa  <i class="fa fa-user-plus user-plus" aria-hidden="true"></i>
        </h1>
        <div class="row" >
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                    <br>
                        <label  class="radio-inline">
                            <input type="radio" name="tp_colab" id="fis" value="Advogado">Pessoa Física
                        </label>


                        <label class="radio-inline">
                            <input type="radio" name="tp_colab" id="jur" value="Funcionário">Pessoa Jurídica 
                        </label>
                        <br>
                        <br>
                        <label for="msg" class="errorMsg" id="errorMsg">{{ $msg }}</label>
                        <br>
                    
                        {!! Form::open(['route'=>'fisica.addPerson' , 'class'=>'form-horizontal', 'id'=>'cpfForm']) !!}
                        <div class="form-group" id="cpf-form" style="display: none;">
                            <label  class="col-md-1 control-label">CPF<span class="asterisk">*</span></label>
                            <div class="col-md-7 form-inline">
                                <input type="text" class="form-control cpf" name="cpf" id="cpf" />
                                <button name="submit" class="btn btn-md btn-info">Próximo</button> 
                            </div>
                        </div>
                        {!! Form::close() !!}

                        {!! Form::open(['route'=>'jurid.addPerson' , 'class'=>'form-horizontal']) !!}

                        <div class="form-group" id="cnpj-form" style="display: none;">
                            <label  class="col-md-1 control-label">CNPJ<span class="asterisk">*</span></label>
                            <div class="col-md-7 form-inline">
                                <input type="text" class="form-control cnpj" name="cnpj"/>
                                <button name="submit" class="btn btn-md btn-info">Próximo</button> 
                            </div>
                        </div>
                      {!! Form::close() !!}
                    </div>
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
       if($(this).attr('id') == 'fis') {
            $('#cpf-form').show();  
            $('#cnpj-form').hide();
       }

       else {
            $('#cpf-form').hide();
            $('#cnpj-form').show(); 
       }
   });
});

    $("#cpfForm").submit(function() {
    $("#cpf").unmask();
});



</script>
@endsection


