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


                        <label class="radio-inline">
                            <input type="radio" name="tp_colab" id="men" value="outro">Outro Documento
                        </label>
                        <br>
                        <br>
                        <label for="msg" class="errorMsg red" id="errorMsg">{{ $msg }}</label>
                        <br>
                    
                        
                        <div class="form-group" id="cpf-form" style="display: none;">
                        {!! Form::open(['route'=>'fisica.addPerson' , 'class'=>'form-horizontal form']) !!}
                            <label  class="col-md-1 control-label">CPF<span class="asterisk">*</span></label>
                            <div class="col-md-7 form-inline">
                                <input type="text" class="form-control cpf" name="cpf" id="cpf" data-validation="required cpf" />
                                <button name="submit" class="btn btn-md btn-info">Próximo</button> 
                            </div>
                            {!! Form::close() !!}
                        </div>
                        

                        <div class="form-group" id="cnpj-form" style="display: none;">
                        {!! Form::open(['route'=>'jurid.addPerson' , 'class'=>'form-horizontal form', 'name'=>'form1']) !!}
                            <label  class="col-md-1 control-label">CNPJ<span class="asterisk">*</span></label>
                            <div class="col-md-7 form-inline">
                                <input type="text" class="form-control cnpj" name="cnpjs" id="cnpj" onBlur="ValidarCNPJ(form1.cnpj);"/>
                                <button name="submit" class="btn btn-md btn-info">Próximo</button> 
                            </div>
                        {!! Form::close() !!}
                        </div>

                        <div class="form-group" id="p-form" style="display: none;">
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
                        </div>
                      
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
            $('#p-form').hide();  
            $('#errorMsg').hide();  
       }

       if($(this).attr('id') == 'jur') {
            $('#cpf-form').hide();
            $('#cnpj-form').show();
            $('#p-form').hide();  
            $('#errorMsg').hide();  
       }
        if($(this).attr('id') == 'men') {
            $('#cpf-form').hide();
            $('#cnpj-form').hide();
            $('#p-form').show(); 
            $('#errorMsg').hide();  
       }

   });

   $('#doc').on('change',function(){
    if( $(this).val()==="rg"){
    $("#rg-form").show()
    $("#rne-form").hide()
    $("#pass-form").hide()
    }
    if( $(this).val()==="rne"){
    $("#rne-form").show()
    $("#rg-form").hide()
    $("#pass-form").hide()
    }
    if( $(this).val()==="sel"){
    $("#rg-form").hide()
    $("#rne-form").hide()
    $("#pass-form").hide()
    }
    if( $(this).val()==="pass"){
    $("#rg-form").hide()
    $("#rne-form").hide()
    $("#pass-form").show()
    }
});
});

</script>
@endsection


