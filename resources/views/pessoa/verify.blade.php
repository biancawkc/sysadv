 @extends('layouts.master2')
 @section('content')
 <div class="container-custom">
    <h1 class="col-lg-12 well "> Cadastro de Parte  <i class="fa fa-user-plus user-plus" aria-hidden="true"></i>
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
                                <input type="text" class="form-control cpf" name="cpf" id="cpf" data-validation="cpf" />
                                <button name="submit" class="btn btn-md btn-info">Próximo</button> 
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
        
        /*if($(this).attr('id') == 'men') {
            $('#cpf-form').hide();
            $('#cnpj-form').hide();
            $('#p-form').show(); 
            $('#errorMsg').hide();  
        }*/

    });

/*   $('#doc').on('change',function(){
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
});*/
});
    function msg()
    {   var cnpj = document.getElementById("cnpj").value;
        if(cnpj == "" )
        {
        $("#cnpj").css("border-color", "#b94a48");
        $("#cnpj").css("box-shadow", "inset 0 1px 1px rgba(0,0,0,0.075)");
        document.getElementById('erro_cnpj').innerHTML = "O CNPJ digitado é inválido";
        document.getElementById("prox").style.display="none";
        }
    }

    function erro()
    {   
        $("#cnpj").css("border-color", "#b94a48");
        $("#cnpj").css("box-shadow", "inset 0 1px 1px rgba(0,0,0,0.075)");
        document.getElementById('erro_cnpj').innerHTML = "O CNPJ digitado é inválido";
        document.getElementById("prox").style.display="none";
    }

    function ValidarCNPJ(ObjCnpj){
        var cnpj = ObjCnpj.value;
        var valida = new Array(6,5,4,3,2,9,8,7,6,5,4,3,2);
        var dig1= 0;
        var dig2= 0;

        exp = /\.|\-|\//g
        cnpj = cnpj.toString().replace( exp, "" ); 
        var digito = new Number(eval(cnpj.charAt(12)+cnpj.charAt(13)));

        for(i = 0; i<valida.length; i++){
            dig1 += (i>0? (cnpj.charAt(i-1)*valida[i]):0);  
            dig2 += cnpj.charAt(i)*valida[i];       
        }
        dig1 = (((dig1%11)<2)? 0:(11-(dig1%11)));
        dig2 = (((dig2%11)<2)? 0:(11-(dig2%11)));

        if(((dig1*10)+dig2) != digito)  
        {   
            $("#cnpj").css("border-color", "#b94a48");
            $("#cnpj").css("box-shadow", "inset 0 1px 1px rgba(0,0,0,0.075)");
             document.getElementById('erro_cnpj').innerHTML = "O CNPJ digitado é inválido";
             $('#prox').hide();
             $('#prox1').show(); 
        }
        else{

            $("#cnpj").css("border-color", "#468847");
            $("#cnpj").css("box-shadow", "inset 0 1px 1px rgba(0,0,0,0.075)");
            document.getElementById('erro_cnpj').innerHTML = "";
            $('#prox1').hide();
            $('#prox').show(); 
        }

    }
</script>
@endsection


