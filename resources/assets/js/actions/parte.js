$.validate({
		modules : 'date'
	});

$(document).on('keyup', '.telefone', function(event) {
		var values = [];
		$('.telefone').each(
			function() {
				if (values.indexOf(this.value) >= 0) {
					//$(this).css("border-color", "rgb(185, 74, 72)", "!important");
					$( this ).parent().addClass("has-error");
					$('#submit').prop("disabled",true);
				}
				else {
					//$(this).css("border-color", ""); 
					$( this ).parent().removeClass("has-error");
					$('#submit').prop("disabled",false);
					values.push(this.value);

				}
			});
	});

$(document).on('keyup', '.real', function(event) {
	var dinheiro = $('.real').val();
	var  val1 = dinheiro.replace('.','');
	var  val = val1.replace(',','.');
	var valor = val.replace('R$','');
	$('.valorV').val(valor);
});