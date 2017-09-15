$(document).ready(function() {

    //$( '.datepicker' ).datepicker();
    var dateToday = new Date(); 
    $('.datepicker').datepicker({
        todayBtn: "linked",
        language: "pt-BR",
        todayHighlight: true,
        weekStart: 0,
        minDate: dateToday
    });
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    $('#flash-overlay-modal').modal();
    $('.single-select').select2( {placeholder: "Selecione ou Digite", allowClear: true, theme: "bootstrap"});
    

    $.validate({
        lang: 'pt',
        modules : 'brazil'

    });

    $(".tblCadastro").dataTable({
      "language": {
          "sEmptyTable": "Nenhum registro encontrado",
          "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
          "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
          "sInfoFiltered": "(Filtrados de _MAX_ registros)",
          "sInfoPostFix": "",
          "sInfoThousands": ".",
          "sLengthMenu": "_MENU_ resultados por página",
          "sLoadingRecords": "Carregando...",
          "sProcessing": "Processando...",
          "sZeroRecords": "Nenhum registro encontrado",
          "sSearch": "Pesquisar",
          "oPaginate": {
            "sNext": "Próximo",
            "sPrevious": "Anterior",
            "sFirst": "Primeiro",
            "sLast": "Último"
        },
        "oAria": {
            "sSortAscending": ": Ordenar colunas de forma ascendente",
            "sSortDescending": ": Ordenar colunas de forma descendente"
        }
    }
});

    $(".form").submit(function() {
        $("#cpf").unmask();
        $("#rg").unmask();
        $("#cep").unmask();
        $("#tel").unmask();
        $("#cnpj").unmask();
        $(".phone_with_ddd").unmask();
    });


    function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
                $("#ibge").val("");
            }
            
            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");
                        $("#ibge").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                        	if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                                $("#ibge").val(dados.ibge);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                       // alert("Formato de CEP inválido.");
                   }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });

            $('.date').mask('00/00/0000');
            $('.cpf').mask('000.000.000-00', {reverse: true});
            $('.cep').mask('00000-000');
            $('.phone_with_ddd').mask('(00) 0000-00000');
            $('.rg').mask('00.000.000-00', {reverse: true});
            $('.cnpj').mask('00.000.000/0000-00', {reverse: true});

            $('[data-toggle="tooltip"]').tooltip(); 

            
            function ValidarCNPJ(ObjCnpj){
                var cnpj = ObjCnpj.value;
                var valida = new Array(6,5,4,3,2,9,8,7,6,5,4,3,2);
                var dig1= new Number;
                var dig2= new Number;

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
                    document.getElementById('erro_cnpj').innerHTML = "* CNPJ inválido";

            }


        });

