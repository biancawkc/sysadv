var selectsDeClientes = [];
  selectCliente.querySelector('a.btn-success').remove();
  selectCliente.querySelector('div.col-sm-2.form-group').appendChild(botaoRemover.get(0).cloneNode(true));

  var x=10;  
	$('#addCl').click(function(){
		var novoSelectCliente = selectCliente.cloneNode(true);

	   $('#cliente').after(novoSelectCliente);  
	   // $(novoSelectCliente).select2({placeholder: "Selecione ou Digite", allowClear: true, theme: "bootstrap"});
	   selectsDeClientes.push(novoSelectCliente);
	   $(novoSelectCliente).find('a.btn_remove').on('click', function(event) {
         var botaoOriginal = $(event.target);
         botaoOriginal.parents('div.forn-group').get(0).remove();
         selectsDeClientes[selectsDeClientes.indexOf(novoSelectCliente)] = undefined;
	   });
	});

	$(document).on('change', 'select.pessoa.cliente', function(event) {
       var idSelecionado = $(event.target).val();
       var jaSelecionado = false;
       selectsDeClientes.forEach(function(select) {
       	if ($(select).val() === idSelecionado) {
       		jaSelecionado = true;
       	}
       });

       if (jaSelecionado) {
       	// invalidar selecao do campo
       	console.log('Cliente ja selecionado', idSelecionado);
       }
	})  

