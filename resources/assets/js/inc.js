$(document).ready(function() {
    $( ".datepicker" ).datepicker({
        dateFormat: 'dd/mm/yy'
    });

    $(".dtParcel").datepicker({
        dateFormat: 'dd/mm/yy',
        minDate: 0
    });

    $(".dtAdmissao").datepicker({
        dateFormat: 'dd/mm/yy',
        maxDate: 0
    });

    $(".dtPag").datepicker({
        dateFormat: 'dd/mm/yy',
        minDate: 0,
        maxDate: 0
    });

    $(".dtIni").datepicker({
        dateFormat: "dd/mm/yy",
        changeMonth: true,
        changeYear: true,
        onSelect: function (date) {
            var date2 = $('.dtIni').datepicker('getDate');
            date2.setDate(date2.getDate());
               // $('#dtFn').datepicker('setDate', date2);
                //sets minDate to dt1 date + 1
                $('.dtFn').datepicker('option', 'minDate', date2);
            }
        });

    $('.dtFn').datepicker({
        dateFormat: "dd/mm/yy",
        changeMonth: true,
        changeYear: true,
        onClose: function () {
            var dt1 = $('.dtIni').datepicker('getDate');
            console.log(dt1);
            var dt2 = $('.dtFn').datepicker('getDate');
            /*if (dt2 < dt1) {
                //var minDate = $('.dtFn').datepicker('option', 'minDate');
               //$('.dtFn').datepicker('setDate', minDate);
            }*/
        }
    });

      $(".etapaIni").datepicker({
        dateFormat: "dd/mm/yy",
        changeMonth: true,
        changeYear: true,
        minDate: 0,
        onSelect: function (date) {
            var date2 = $('.etapaIni').datepicker('getDate');
            date2.setDate(date2.getDate());
               // $('#dtFn').datepicker('setDate', date2);
                //sets minDate to dt1 date + 1
                $('.etapaFn').datepicker('option', 'minDate', date2);
            }
        });

    $('.etapaFn').datepicker({
        dateFormat: "dd/mm/yy",
        onClose: function () {
            var dt1 = $('.etapaIni').datepicker('getDate');
            console.log(dt1);
            var dt2 = $('.etapaFn').datepicker('getDate');
            /*if (dt2 < dt1) {
                var minDate = $('.dtFn').datepicker('option', 'minDate');
                $('.dtFn').datepicker('setDate', minDate);
            }*/
        }
    });

   
    ( function( factory ) {
        if ( typeof define === "function" && define.amd ) {

        // AMD. Register as an anonymous module.
        define( [ "../widgets/datepicker" ], factory );
    } else {

        // Browser globals
        factory( jQuery.datepicker );
    }
}( function( datepicker ) {

    datepicker.regional[ "pt-BR" ] = {
        closeText: "Fechar",
        prevText: "&#x3C;Anterior",
        nextText: "Próximo&#x3E;",
        currentText: "Hoje",
        monthNames: [ "Janeiro","Fevereiro","Março","Abril","Maio","Junho",
        "Julho","Agosto","Setembro","Outubro","Novembro","Dezembro" ],
        monthNamesShort: [ "Jan","Fev","Mar","Abr","Mai","Jun",
        "Jul","Ago","Set","Out","Nov","Dez" ],
        dayNames: [
        "Domingo",
        "Segunda-feira",
        "Terça-feira",
        "Quarta-feira",
        "Quinta-feira",
        "Sexta-feira",
        "Sábado"
        ],
        dayNamesShort: [ "Dom","Seg","Ter","Qua","Qui","Sex","Sáb" ],
        dayNamesMin: [ "Dom","Seg","Ter","Qua","Qui","Sex","Sáb" ],
        weekHeader: "Sm",
        dateFormat: "dd/mm/yy",
        firstDay: 0,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: "" };
        datepicker.setDefaults( datepicker.regional[ "pt-BR" ] );

        return datepicker.regional[ "pt-BR" ];

    } ) );

    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    $('#flash-overlay-modal').modal();
    $('.single-select').select2( {placeholder: "Selecione ou Digite", allowClear: true, theme: "bootstrap"});
    $('.error-alert').delay(3000).fadeOut(350);
    
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
        $(".money").unmask();
        $(".ctps_serie").unmask();
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
            $('.ctps_serie').mask('000-0')
            $('.phone_with_ddd').mask('(00) 0000-00000');
            $('.rg').mask('00.000.000-0', {reverse: true});
            $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
            $(".money").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});

            $('[data-toggle="tooltip"]').tooltip(); 

        });

