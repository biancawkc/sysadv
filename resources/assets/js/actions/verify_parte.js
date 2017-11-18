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
        document.getElementById("erro_cnpj").innerHTML = "O CNPJ digitado é inválido";
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